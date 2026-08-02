<?php

namespace Tests\Feature;

use App\Models\AdminNotification;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use App\Models\PaymentVerification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MultiTenancyIsolationTest extends TestCase
{
    use RefreshDatabase;

    private Package $package;
    private Package $packageA;
    private Package $packageB;
    private \App\Models\PaymentMethod $methodA;
    private \App\Models\PaymentMethod $methodB;
    private Business $businessA;
    private Business $businessB;
    private Customer $superAdmin;
    private Customer $ownerA;
    private Customer $ownerB;
    private Order $orderA;
    private Order $orderB;
    private PaymentVerification $verificationA;
    private PaymentVerification $verificationB;

    protected function setUp(): void
    {
        parent::setUp();

        $this->package = Package::create([
            'name' => 'Test Hosting',
            'price' => 100,
            'type' => 'hosting',
            'is_active' => true,
        ]);

        $this->businessA = Business::create([
            'name' => 'Business A',
            'slug' => 'business-a',
            'owner_name' => 'Owner A',
            'owner_email' => 'owner-a@test.com',
            'owner_phone' => '0911111111',
            'is_active' => true,
            'status' => Business::STATUS_APPROVED,
        ]);

        $this->businessB = Business::create([
            'name' => 'Business B',
            'slug' => 'business-b',
            'owner_name' => 'Owner B',
            'owner_email' => 'owner-b@test.com',
            'owner_phone' => '0922222222',
            'is_active' => true,
            'status' => Business::STATUS_APPROVED,
        ]);

        $this->superAdmin = Customer::create([
            'name' => 'Super Admin',
            'email' => 'super@test.com',
            'phone' => '0900000000',
            'password_hash' => Hash::make('password'),
            'is_active' => true,
            'role' => Customer::ROLE_SUPER_ADMIN,
        ]);

        $this->ownerA = $this->makeOwner('owner-a@test.com', $this->businessA->id);
        $this->ownerB = $this->makeOwner('owner-b@test.com', $this->businessB->id);

        $this->orderA = $this->makeOrder($this->businessA->id, 'ORD-TEST-AAAA');
        $this->orderB = $this->makeOrder($this->businessB->id, 'ORD-TEST-BBBB');

        $this->verificationA = $this->makeVerification($this->orderA);
        $this->verificationB = $this->makeVerification($this->orderB);

        $this->packageA = Package::create([
            'name' => 'Package A',
            'price' => 50,
            'type' => 'hosting',
            'is_active' => true,
            'business_id' => $this->businessA->id,
        ]);

        $this->packageB = Package::create([
            'name' => 'Package B',
            'price' => 60,
            'type' => 'hosting',
            'is_active' => true,
            'business_id' => $this->businessB->id,
        ]);

        $this->methodA = \App\Models\PaymentMethod::create([
            'name' => 'Bank A',
            'account_number' => '1000000001',
            'account_name' => 'Business A',
            'is_active' => true,
            'business_id' => $this->businessA->id,
        ]);

        $this->methodB = \App\Models\PaymentMethod::create([
            'name' => 'Bank B',
            'account_number' => '1000000002',
            'account_name' => 'Business B',
            'is_active' => true,
            'business_id' => $this->businessB->id,
        ]);
    }

    private function makeOwner(string $email, int $businessId): Customer
    {
        return Customer::create([
            'name' => $email,
            'email' => $email,
            'phone' => '09' . substr(md5($email), 0, 8),
            'phone_verified_at' => now(),
            'password_hash' => Hash::make('password'),
            'is_active' => true,
            'role' => Customer::ROLE_BUSINESS_OWNER,
            'business_id' => $businessId,
        ]);
    }

    private function makeOrder(int $businessId, string $orderNumber): Order
    {
        return Order::create([
            'order_number' => $orderNumber,
            'package_id' => $this->package->id,
            'status' => 'pending',
            'total_amount' => 100,
            'currency' => 'ETB',
            'customer_id' => $this->superAdmin->id,
            'business_id' => $businessId,
            'customer_details' => ['name' => 'Cust', 'email' => 'cust@test.com', 'phone' => '0911111111'],
        ]);
    }

    private function makeVerification(Order $order): PaymentVerification
    {
        $payment = Payment::create([
            'order_id' => $order->id,
            'amount' => 100,
            'currency' => 'ETB',
            'payment_method' => 'bank',
        ]);

        return PaymentVerification::create([
            'payment_id' => $payment->id,
            'order_id' => $order->id,
            'business_id' => $order->business_id,
            'bank_slip_path' => 'slips/test.png',
            'customer_name' => 'Cust',
            'transaction_reference' => $order->order_number . '-TX',
            'status' => 'pending',
        ]);
    }

    public function test_super_admin_sees_all_businesses_data(): void
    {
        $this->actingAs($this->superAdmin);

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee($this->orderA->order_number)
            ->assertSee($this->orderB->order_number);

        $this->get(route('admin.verifications.show', $this->verificationA))->assertOk();
        $this->get(route('admin.verifications.show', $this->verificationB))->assertOk();
    }

    public function test_owner_only_sees_own_business_verifications(): void
    {
        $this->actingAs($this->ownerA);

        $response = $this->get(route('admin.verifications.index'));
        $response->assertOk()
            ->assertSee($this->verificationA->transaction_reference)
            ->assertDontSee($this->verificationB->transaction_reference);
    }

    public function test_owner_cannot_access_another_businesses_verification(): void
    {
        $this->actingAs($this->ownerA);

        $this->get(route('admin.verifications.show', $this->verificationB))->assertForbidden();
        $this->get(route('admin.verifications.slip', $this->verificationB))->assertForbidden();
        $this->post(route('admin.verifications.process', $this->verificationB), ['action' => 'approve'])
            ->assertForbidden();
    }

    public function test_owner_can_access_own_verification(): void
    {
        $this->actingAs($this->ownerA);

        $this->get(route('admin.verifications.show', $this->verificationA))->assertOk();
    }

    public function test_owner_dashboard_counts_are_scoped(): void
    {
        AdminNotification::create([
            'type' => 'payment_verification',
            'title' => 'New submission A',
            'link' => route('admin.verifications.show', $this->verificationA),
            'business_id' => $this->businessA->id,
        ]);
        AdminNotification::create([
            'type' => 'payment_verification',
            'title' => 'New submission B',
            'link' => route('admin.verifications.show', $this->verificationB),
            'business_id' => $this->businessB->id,
        ]);

        $this->actingAs($this->ownerA);

        $this->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('New submission A')
            ->assertDontSee('New submission B');
    }

    public function test_owner_cannot_manage_other_businesses(): void
    {
        $this->actingAs($this->ownerA);

        $this->get(route('admin.businesses.index'))->assertForbidden();
        $this->get(route('admin.businesses.create'))->assertForbidden();
    }

    public function test_regular_customer_is_blocked_from_admin(): void    {
        $customer = Customer::create([
            'name' => 'Plain Customer',
            'email' => 'plain@test.com',
            'phone' => '0933333333',
            'password_hash' => Hash::make('password'),
            'is_active' => true,
            'role' => Customer::ROLE_CUSTOMER,
        ]);

        $this->actingAs($customer)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_entering_business_redirects_home(): void
    {
        $this->get(route('business.enter', $this->businessA))
            ->assertRedirect(route('home'));
    }

    public function test_orders_are_stamped_with_the_business_from_session(): void
    {
        $customer = Customer::create([
            'name' => 'Shopper',
            'email' => 'shopper@test.com',
            'phone' => '0944444444',
            'password_hash' => Hash::make('password'),
            'is_active' => true,
            'role' => Customer::ROLE_CUSTOMER,
        ]);

        $this->actingAs($customer)
            ->withSession([
                'business_id' => $this->businessA->id,
                'order_data' => [
                    'package_id' => $this->package->id,
                    'domain_name' => 'example.com',
                    'domain_type' => 'register',
                ],
            ])
            ->post(route('orders.yegara-place'), ['payment_method' => 'bank'])
            ->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'customer_id' => $customer->id,
            'business_id' => $this->businessA->id,
        ]);
    }

    public function test_orders_without_business_are_global(): void
    {
        $customer = Customer::create([
            'name' => 'Shopper Two',
            'email' => 'shopper2@test.com',
            'phone' => '0955555555',
            'password_hash' => Hash::make('password'),
            'is_active' => true,
            'role' => Customer::ROLE_CUSTOMER,
        ]);

        $this->actingAs($customer)
            ->withSession([
                'order_data' => [
                    'package_id' => $this->package->id,
                    'domain_name' => 'example.org',
                    'domain_type' => 'register',
                ],
            ])
            ->post(route('orders.yegara-place'), ['payment_method' => 'bank'])
            ->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'customer_id' => $customer->id,
            'business_id' => null,
        ]);

        $this->actingAs($this->superAdmin)
            ->get(route('admin.dashboard'))
            ->assertOk();
    }

    public function test_owner_sees_only_own_packages_and_payment_methods(): void
    {
        $this->actingAs($this->ownerA);

        $this->get(route('admin.packages.index'))
            ->assertOk()
            ->assertSee($this->packageA->name)
            ->assertDontSee($this->packageB->name);

        $this->get(route('admin.payment-methods.index'))
            ->assertOk()
            ->assertSee($this->methodA->name)
            ->assertDontSee($this->methodB->name);
    }

    public function test_owner_cannot_edit_or_delete_other_businesses_catalog(): void
    {
        $this->actingAs($this->ownerA);

        $this->get(route('admin.packages.edit', $this->packageB))->assertForbidden();
        $this->get(route('admin.payment-methods.edit', $this->methodB))->assertForbidden();
    }

    public function test_super_admin_sees_platform_and_all_business_catalog(): void
    {
        $this->actingAs($this->superAdmin);

        $this->get(route('admin.packages.index'))
            ->assertOk()
            ->assertSee($this->packageA->name)
            ->assertSee($this->packageB->name)
            ->assertSee($this->package->name);

        $this->get(route('admin.payment-methods.index'))
            ->assertOk()
            ->assertSee($this->methodA->name)
            ->assertSee($this->methodB->name);
    }

    public function test_order_for_business_package_without_session_goes_to_package_business(): void
    {
        $customer = Customer::create([
            'name' => 'Shopper Three',
            'email' => 'shopper3@test.com',
            'phone' => '0966666666',
            'password_hash' => Hash::make('password'),
            'is_active' => true,
            'role' => Customer::ROLE_CUSTOMER,
        ]);

        $this->actingAs($customer)
            ->withSession([
                'order_data' => [
                    'package_id' => $this->packageA->id,
                    'domain_name' => 'example.net',
                    'domain_type' => 'register',
                ],
            ])
            ->post(route('orders.yegara-place'), ['payment_method' => 'bank'])
            ->assertRedirect();

        $this->assertDatabaseHas('orders', [
            'customer_id' => $customer->id,
            'business_id' => $this->businessA->id,
        ]);
    }

    public function test_owner_created_package_and_method_are_stamped_to_their_business(): void
    {
        $this->actingAs($this->ownerA);

        $this->post(route('admin.packages.store'), [
            'name' => 'Own Package',
            'description' => 'desc',
            'price' => 10,
            'currency' => 'ETB',
            'type' => 'hosting',
            'is_active' => 1,
        ])->assertRedirect();

        $this->assertDatabaseHas('packages', [
            'name' => 'Own Package',
            'business_id' => $this->businessA->id,
        ]);

        $this->post(route('admin.payment-methods.store'), [
            'name' => 'Own Bank',
            'account_number' => '2000000001',
            'account_name' => 'Owner A',
            'is_active' => 1,
        ])->assertRedirect();

        $this->assertDatabaseHas('payment_methods', [
            'name' => 'Own Bank',
            'business_id' => $this->businessA->id,
        ]);
    }
}
