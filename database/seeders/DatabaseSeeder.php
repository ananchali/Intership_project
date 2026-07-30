<?php

namespace Database\Seeders;

use App\Models\Package;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Package::create([
            'name' => 'Basic Hosting',
            'description' => 'Perfect for small websites and personal blogs.',
            'price' => 500.00,
            'currency' => 'ETB',
            'type' => 'hosting',
            'features' => ['1GB Storage', '10GB Bandwidth', '1 Email Account'],
            'is_active' => true,
        ]);

        Package::create([
            'name' => 'Standard Hosting',
            'description' => 'Ideal for growing businesses and professional portfolios.',
            'price' => 1500.00,
            'currency' => 'ETB',
            'type' => 'hosting',
            'features' => ['5GB Storage', '50GB Bandwidth', '10 Email Accounts', 'Free SSL'],
            'is_active' => true,
        ]);

        Package::create([
            'name' => 'Premium Hosting',
            'description' => 'Maximum performance for large scale applications.',
            'price' => 3000.00,
            'currency' => 'ETB',
            'type' => 'hosting',
            'features' => ['Unlimited Storage', 'Unlimited Bandwidth', 'Unlimited Emails', 'Free SSL', 'Priority Support'],
            'is_active' => true,
        ]);
        
        Package::create([
            'name' => '.com Domain',
            'description' => 'The most popular top-level domain.',
            'price' => 1200.00,
            'currency' => 'ETB',
            'type' => 'domain',
            'features' => ['1 Year Registration', 'DNS Management'],
            'is_active' => true,
        ]);
    }
}
