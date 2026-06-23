<?php

namespace Tests\Unit\Models;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    use RefreshDatabase;

    private function createPaymentMethod(array $attributes = []): PaymentMethod
    {
        return PaymentMethod::create(array_merge([
            'name' => 'Commercial Bank of Ethiopia',
            'account_number' => '1000123456789',
            'account_name' => 'Yegara Hosting',
            'instructions' => 'Transfer to this account and upload receipt',
            'is_active' => true,
        ], $attributes));
    }

    public function test_payment_method_can_be_created(): void
    {
        $method = $this->createPaymentMethod();

        $this->assertDatabaseHas('payment_methods', ['name' => 'Commercial Bank of Ethiopia']);
        $this->assertEquals('1000123456789', $method->account_number);
    }

    public function test_is_active_cast_to_boolean(): void
    {
        $method = $this->createPaymentMethod(['is_active' => 1]);

        $this->assertIsBool($method->is_active);
        $this->assertTrue($method->is_active);
    }

    public function test_inactive_payment_method(): void
    {
        $method = $this->createPaymentMethod(['is_active' => false]);

        $this->assertFalse($method->is_active);
    }

    public function test_fillable_attributes(): void
    {
        $method = new PaymentMethod();
        $expected = ['name', 'account_number', 'account_name', 'instructions', 'is_active'];

        $this->assertEquals($expected, $method->getFillable());
    }

    public function test_multiple_payment_methods(): void
    {
        $this->createPaymentMethod(['name' => 'CBE', 'account_number' => '111']);
        $this->createPaymentMethod(['name' => 'Awash Bank', 'account_number' => '222']);
        $this->createPaymentMethod(['name' => 'Dashen Bank', 'account_number' => '333', 'is_active' => false]);

        $activeMethods = PaymentMethod::where('is_active', true)->get();
        $allMethods = PaymentMethod::all();

        $this->assertCount(2, $activeMethods);
        $this->assertCount(3, $allMethods);
    }
}
