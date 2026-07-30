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
            // Services Packages - Organized by Provider
            // Schools & Universities
            [
                'name' => 'Bethel Academy',
                'description' => 'Complete school management with grade-based tuition',
                'price' => 0,
                'registration_fee' => 500,
                'monthly_fee' => 800,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Schools & Universities',
                'features' => [
                    'levels' => [
                        ['name' => 'Kindergarten', 'fee' => 1500],
                        ['name' => 'Grade 1-3', 'fee' => 2000],
                        ['name' => 'Grade 4-6', 'fee' => 2500],
                        ['name' => 'Grade 7-8', 'fee' => 3000],
                    ]
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Holy Trinity Cathedral School',
                'description' => 'Faith-based education with comprehensive IT management',
                'price' => 0,
                'registration_fee' => 400,
                'monthly_fee' => 600,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Schools & Universities',
                'features' => [
                    'levels' => [
                        ['name' => 'Elementary', 'fee' => 1200],
                        ['name' => 'Junior Secondary', 'fee' => 1800],
                        ['name' => 'Senior Secondary', 'fee' => 2500],
                    ]
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Addis Ababa University',
                'description' => 'Higher education institution with faculty-level pricing',
                'price' => 0,
                'registration_fee' => 1000,
                'monthly_fee' => 2000,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Schools & Universities',
                'features' => [
                    'levels' => [
                        ['name' => 'Faculty of Science', 'fee' => 5000],
                        ['name' => 'Faculty of Engineering', 'fee' => 6000],
                        ['name' => 'Faculty of Medicine', 'fee' => 8000],
                        ['name' => 'Faculty of Business', 'fee' => 4000],
                    ]
                ],
                'is_active' => true,
            ],
            // Hospitals & Clinics
            [
                'name' => 'Black Lion Hospital',
                'description' => 'Comprehensive healthcare service with department-level pricing',
                'price' => 0,
                'registration_fee' => 300,
                'monthly_fee' => 1500,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Hospitals & Clinics',
                'features' => [
                    'levels' => [
                        ['name' => 'Outpatient Service', 'fee' => 500],
                        ['name' => 'Inpatient Service', 'fee' => 2000],
                        ['name' => 'Specialist Consultation', 'fee' => 1000],
                        ['name' => 'Emergency Service', 'fee' => 1500],
                    ]
                ],
                'is_active' => true,
            ],
            [
                'name' => 'St. Paul\'s Hospital',
                'description' => 'Full-service hospital with dedicated IT management',
                'price' => 0,
                'registration_fee' => 250,
                'monthly_fee' => 1200,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Hospitals & Clinics',
                'features' => [
                    'levels' => [
                        ['name' => 'General Ward', 'fee' => 800],
                        ['name' => 'Private Ward', 'fee' => 2500],
                        ['name' => 'ICU', 'fee' => 3500],
                    ]
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Yeka Diagnostic Center',
                'description' => 'Modern diagnostic center with advanced IT solutions',
                'price' => 0,
                'registration_fee' => 200,
                'monthly_fee' => 900,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Hospitals & Clinics',
                'features' => [
                    'levels' => [
                        ['name' => 'Basic Package', 'fee' => 600],
                        ['name' => 'Standard Package', 'fee' => 1200],
                        ['name' => 'Premium Package', 'fee' => 2000],
                    ]
                ],
                'is_active' => true,
            ],
            // Governmental Institutions
            [
                'name' => 'Addis Ababa City Administration',
                'description' => 'Government service tiers with full registration and monthly retainer',
                'price' => 0,
                'registration_fee' => 1000,
                'monthly_fee' => 3000,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Governmental Institutions',
                'features' => [
                    'levels' => [
                        ['name' => 'Basic Service', 'fee' => 5000],
                        ['name' => 'Standard Service', 'fee' => 8000],
                        ['name' => 'Enterprise Service', 'fee' => 12000],
                        ['name' => 'Premium Service', 'fee' => 20000],
                    ]
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Ministry of Education',
                'description' => 'National education sector with comprehensive IT management',
                'price' => 0,
                'registration_fee' => 1500,
                'monthly_fee' => 4000,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Governmental Institutions',
                'features' => [
                    'levels' => [
                        ['name' => 'Regional Office', 'fee' => 6000],
                        ['name' => 'Zonal Office', 'fee' => 10000],
                        ['name' => 'Head Office', 'fee' => 18000],
                    ]
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Ethiopian Revenue Service',
                'description' => 'Tax authority with secure enterprise-grade hosting',
                'price' => 0,
                'registration_fee' => 2000,
                'monthly_fee' => 5000,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Governmental Institutions',
                'features' => [
                    'levels' => [
                        ['name' => 'Branch Office', 'fee' => 8000],
                        ['name' => 'Regional HQ', 'fee' => 15000],
                        ['name' => 'National HQ', 'fee' => 25000],
                    ]
                ],
                'is_active' => true,
            ],
            // Private Businesses
            [
                'name' => 'Habesha Breweries S.C.',
                'description' => 'Business service packages with tiered subscription pricing',
                'price' => 0,
                'registration_fee' => 200,
                'monthly_fee' => 1200,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Private Businesses',
                'features' => [
                    'levels' => [
                        ['name' => 'Starter Package', 'fee' => 1500],
                        ['name' => 'Professional Package', 'fee' => 3000],
                        ['name' => 'Enterprise Package', 'fee' => 6000],
                    ]
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Ethio Telecom',
                'description' => 'Telecommunications giant with robust IT infrastructure management',
                'price' => 0,
                'registration_fee' => 500,
                'monthly_fee' => 2500,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Private Businesses',
                'features' => [
                    'levels' => [
                        ['name' => 'Regional Office', 'fee' => 4000],
                        ['name' => 'Divisional HQ', 'fee' => 8000],
                        ['name' => 'Corporate HQ', 'fee' => 15000],
                    ]
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Zemen Bank',
                'description' => 'Banking institution with secure financial-grade hosting',
                'price' => 0,
                'registration_fee' => 800,
                'monthly_fee' => 3000,
                'currency' => 'ETB',
                'type' => 'services',
                'provider' => 'Private Businesses',
                'features' => [
                    'levels' => [
                        ['name' => 'Branch Banking', 'fee' => 5000],
                        ['name' => 'Regional Banking', 'fee' => 10000],
                        ['name' => 'Head Office', 'fee' => 20000],
                    ]
                ],
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
