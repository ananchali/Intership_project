<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PaymentMethod::create([
            'name' => 'CBE',
            'account_number' => '1000123456789',
            'account_name' => 'Afronex Hosting Clone',
            'instructions' => 'Please make sure to include the order number in the reference.',
            'is_active' => true,
        ]);

        \App\Models\PaymentMethod::create([
            'name' => 'Telebirr',
            'account_number' => '0911234567',
            'account_name' => 'Afronex Hosting Clone',
            'instructions' => 'Fast and easy mobile payment.',
            'is_active' => true,
        ]);

        \App\Models\PaymentMethod::create([
            'name' => 'CBE Birr',
            'account_number' => '0911234567',
            'account_name' => 'Afronex Hosting Clone',
            'is_active' => true,
        ]);
    }
}
