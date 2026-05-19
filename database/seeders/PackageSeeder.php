<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            // Hosting Packages
            [
                'name' => 'Basic Hosting',
                'description' => 'Perfect for small websites and personal blogs',
                'price' => 500,
                'currency' => 'ETB',
                'type' => 'hosting',
                'features' => [
                    '1GB Storage',
                    '10GB Bandwidth',
                    '1 Email Account',
                    'Free SSL Certificate',
                    '24/7 Support'
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Professional Hosting',
                'description' => 'Ideal for growing businesses and e-commerce',
                'price' => 1200,
                'currency' => 'ETB',
                'type' => 'hosting',
                'features' => [
                    '10GB Storage',
                    '100GB Bandwidth',
                    '10 Email Accounts',
                    'Free SSL Certificate',
                    'Daily Backups',
                    '24/7 Support'
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Enterprise Hosting',
                'description' => 'Maximum performance for large websites',
                'price' => 2500,
                'currency' => 'ETB',
                'type' => 'hosting',
                'features' => [
                    '50GB Storage',
                    'Unlimited Bandwidth',
                    'Unlimited Email Accounts',
                    'Free SSL Certificate',
                    'Daily Backups',
                    'Priority Support',
                    'Dedicated Resources'
                ],
                'is_active' => true,
            ],
            // Domain Packages
            [
                'name' => '.com Domain Registration',
                'description' => 'Register your .com domain for 1 year',
                'price' => 800,
                'currency' => 'ETB',
                'type' => 'domain',
                'features' => [
                    '1 Year Registration',
                    'Free DNS Management',
                    'Domain Forwarding',
                    'Email Forwarding',
                    'Privacy Protection'
                ],
                'is_active' => true,
            ],
            [
                'name' => '.et Domain Registration',
                'description' => 'Register your Ethiopian domain for 1 year',
                'price' => 600,
                'currency' => 'ETB',
                'type' => 'domain',
                'features' => [
                    '1 Year Registration',
                    'Free DNS Management',
                    'Domain Forwarding',
                    'Email Forwarding',
                    'Local Support'
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Premium Domain Bundle',
                'description' => 'Domain + Basic Hosting package',
                'price' => 1000,
                'currency' => 'ETB',
                'type' => 'domain',
                'features' => [
                    '1 Year Domain Registration',
                    'Basic Hosting (1GB)',
                    '1 Email Account',
                    'Free SSL Certificate',
                    'DNS Management'
                ],
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
