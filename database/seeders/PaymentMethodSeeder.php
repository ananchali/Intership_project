<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\PaymentMethod::create([
            'name' => 'CBE',
            'account_number' => '1000123456789',
            'account_name' => 'Afronex Hosting Clone',
            'instructions' => 'Please make sure to include the order number in the reference.',
            'applicable_to' => 'hosting,domain',
            'is_active' => true,
        ]);

        \App\Models\PaymentMethod::create([
            'name' => 'Telebirr',
            'account_number' => '0911234567',
            'account_name' => 'Afronex Hosting Clone',
            'instructions' => 'Fast and easy mobile payment.',
            'applicable_to' => 'all',
            'is_active' => true,
        ]);

        \App\Models\PaymentMethod::create([
            'name' => 'CBE Birr',
            'account_number' => '0911234567',
            'account_name' => 'Afronex Hosting Clone',
            'applicable_to' => 'services',
            'is_active' => true,
        ]);
    }
}
