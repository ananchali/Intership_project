<?php

namespace Tests\Feature;

use App\Models\AdminNotification;
use App\Models\Business;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class VendorOnboardingTest extends TestCase
{
    use RefreshDatabase;

    private Customer $superAdmin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->superAdmin = Customer::create([
            'name' => 'Super Admin',
            'email' => 'super@test.com',
            'phone' => '0900000000',
            'password_hash' => Hash::make('password'),
            'is_active' => true,
            'role' => Customer::ROLE_SUPER_ADMIN,
        ]);
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'business_name' => 'New Vendor Hotel',
            'owner_name' => 'New Owner',
            'owner_email' => 'newowner@test.com',
            'owner_phone' => '0912345678',
            'password' => 'Strong@123',
            'password_confirmation' => 'Strong@123',
        ], $overrides);
    }

    private function makePendingVendor(): Business
    {
        $business = Business::create([
            'name' => 'Pending Biz',
            'slug' => 'pending-biz',
            'owner_name' => 'Pending Owner',
            'owner_email' => 'pending@test.com',
            'owner_phone' => '0911111111',
            'is_active' => false,
            'status' => Business::STATUS_PENDING,
        ]);

        Customer::create([
            'name' => 'Pending Owner',
            'email' => 'pending@test.com',
            'phone' => '0911111111',
            'phone_verified_at' => now(),
            'password_hash' => Hash::make('Strong@123'),
            'is_active' => true,
            'role' => Customer::ROLE_BUSINESS_OWNER,
            'business_id' => $business->id,
        ]);

        return $business;
    }

    public function test_vendor_can_register_their_business_for_approval(): void
    {
        $this->withSession(['otp_verified_phone' => '0912345678'])
            ->post(route('vendor.register.submit'), $this->validPayload())
            ->assertRedirect(route('login'));

        $this->assertDatabaseHas('businesses', [
            'name' => 'New Vendor Hotel',
            'slug' => 'new-vendor-hotel',
            'status' => Business::STATUS_PENDING,
            'is_active' => false,
        ]);

        $this->assertDatabaseHas('customers', [
            'email' => 'newowner@test.com',
            'role' => Customer::ROLE_BUSINESS_OWNER,
        ]);

        $this->assertDatabaseHas('admin_notifications', [
            'type' => 'business_request',
            'business_id' => null,
        ]);
    }

    public function test_vendor_registration_requires_otp_verification(): void
    {
        $this->post(route('vendor.register.submit'), $this->validPayload())
            ->assertSessionHasErrors('owner_phone');

        $this->assertDatabaseMissing('businesses', ['slug' => 'new-vendor-hotel']);
    }

    public function test_vendor_registration_fails_without_owner_phone(): void
    {
        $this->withSession(['otp_verified_phone' => '0912345678'])
            ->post(route('vendor.register.submit'), $this->validPayload(['owner_phone' => '']))
            ->assertSessionHasErrors('owner_phone');

        $this->assertDatabaseMissing('businesses', ['slug' => 'new-vendor-hotel']);
    }

    public function test_vendor_registration_rejects_duplicate_email(): void
    {
        $this->withSession(['otp_verified_phone' => '0912345678'])
            ->post(route('vendor.register.submit'), $this->validPayload())
            ->assertRedirect(route('login'));

        $this->withSession(['otp_verified_phone' => '0911111111'])
            ->post(route('vendor.register.submit'), $this->validPayload())
            ->assertSessionHasErrors('owner_email');
    }

    public function test_pending_owner_is_blocked_from_admin_panel(): void
    {
        $business = $this->makePendingVendor();
        $owner = Customer::where('email', 'pending@test.com')->first();

        $this->actingAs($owner)
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('home'));
    }

    public function test_pending_business_order_link_returns_404(): void
    {
        $business = $this->makePendingVendor();

        $this->get(route('business.enter', $business->slug))->assertNotFound();
    }

    public function test_super_admin_approves_business_and_owner_gains_access(): void
    {
        $business = $this->makePendingVendor();
        $owner = Customer::where('email', 'pending@test.com')->first();

        $this->actingAs($this->superAdmin)
            ->post(route('admin.businesses.approve', $business->slug))
            ->assertRedirect(route('admin.businesses.index'));

        $this->assertDatabaseHas('businesses', [
            'id' => $business->id,
            'status' => Business::STATUS_APPROVED,
            'is_active' => true,
        ]);

        $this->actingAs($owner)
            ->get(route('admin.dashboard'))
            ->assertOk();
    }

    public function test_super_admin_rejects_business_and_owner_remains_blocked(): void
    {
        $business = $this->makePendingVendor();
        $owner = Customer::where('email', 'pending@test.com')->first();

        $this->actingAs($this->superAdmin)
            ->post(route('admin.businesses.reject', $business->slug))
            ->assertRedirect(route('admin.businesses.index'));

        $this->assertDatabaseHas('businesses', [
            'id' => $business->id,
            'status' => Business::STATUS_REJECTED,
        ]);

        $this->actingAs($owner)
            ->get(route('admin.dashboard'))
            ->assertRedirect(route('home'));
    }

    public function test_business_owner_cannot_approve_businesses(): void
    {
        $business = $this->makePendingVendor();
        $owner = Customer::where('email', 'pending@test.com')->first();
        $owner->business->update(['status' => Business::STATUS_APPROVED]);

        $this->actingAs($owner)
            ->post(route('admin.businesses.approve', $business->slug))
            ->assertForbidden();
    }

    public function test_admin_notification_is_created_on_vendor_registration(): void
    {
        $this->withSession(['otp_verified_phone' => '0912345678'])
            ->post(route('vendor.register.submit'), $this->validPayload());

        $this->assertDatabaseHas('admin_notifications', [
            'type' => 'business_request',
            'title' => 'New Business Registration',
        ]);
    }
}
