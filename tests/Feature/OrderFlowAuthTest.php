<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class OrderFlowAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_order_flow(): void
    {
        $this->get(route('orders.yegara-flow'))
            ->assertRedirect(route('login'));
    }

    public function test_guest_cannot_post_to_order_flow(): void
    {
        $this->post(route('orders.yegara-place'), ['payment_method' => 'bank'])
            ->assertRedirect(route('login'));

        $this->post(route('orders.yegara-step2-domain'), [
            'package_id' => 1,
            'domain_name' => 'example.com',
            'domain_type' => 'register',
        ])->assertRedirect(route('login'));
    }

    public function test_authenticated_customer_can_access_order_flow(): void
    {
        $customer = Customer::create([
            'name' => 'Shopper',
            'email' => 'shopper@test.com',
            'phone' => '0912345678',
            'password_hash' => Hash::make('password'),
            'is_active' => true,
            'role' => Customer::ROLE_CUSTOMER,
        ]);

        $this->actingAs($customer)
            ->get(route('orders.yegara-flow'))
            ->assertOk();
    }

    public function test_guest_cannot_access_legacy_order_flow(): void
    {
        $this->get(route('orders.step1'))
            ->assertRedirect(route('login'));

        $this->post(route('orders.placeOrder'), ['package_id' => 1])
            ->assertRedirect(route('login'));
    }

    public function test_guest_cannot_access_order_success_page(): void
    {
        $this->get(route('orders.success'))
            ->assertRedirect(route('login'));
    }
}
