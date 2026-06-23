<?php

namespace Tests\Unit\Models;

use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PackageTest extends TestCase
{
    use RefreshDatabase;

    private function createPackage(array $attributes = []): Package
    {
        return Package::create(array_merge([
            'name' => 'Basic Hosting',
            'description' => 'A basic hosting package',
            'price' => 1500.00,
            'currency' => 'ETB',
            'type' => 'hosting',
            'features' => ['5GB Storage', '1 Email'],
            'is_active' => true,
        ], $attributes));
    }

    public function test_package_can_be_created(): void
    {
        $package = $this->createPackage();

        $this->assertDatabaseHas('packages', ['name' => 'Basic Hosting']);
        $this->assertEquals('Basic Hosting', $package->name);
        $this->assertEquals(1500.00, $package->price);
        $this->assertEquals('ETB', $package->currency);
        $this->assertEquals('hosting', $package->type);
    }

    public function test_features_cast_to_array(): void
    {
        $package = $this->createPackage(['features' => ['Feature A', 'Feature B', 'Feature C']]);

        $this->assertIsArray($package->features);
        $this->assertCount(3, $package->features);
        $this->assertContains('Feature A', $package->features);
    }

    public function test_is_active_cast_to_boolean(): void
    {
        $package = $this->createPackage(['is_active' => 1]);

        $this->assertIsBool($package->is_active);
        $this->assertTrue($package->is_active);
    }

    public function test_scope_active_returns_only_active_packages(): void
    {
        $this->createPackage(['name' => 'Active Package', 'is_active' => true]);
        $this->createPackage(['name' => 'Inactive Package', 'is_active' => false]);

        $activePackages = Package::active()->get();

        $this->assertCount(1, $activePackages);
        $this->assertEquals('Active Package', $activePackages->first()->name);
    }

    public function test_scope_by_type_filters_by_type(): void
    {
        $this->createPackage(['name' => 'Hosting Package', 'type' => 'hosting']);
        $this->createPackage(['name' => 'Domain Package', 'type' => 'domain']);

        $hostingPackages = Package::byType('hosting')->get();
        $domainPackages = Package::byType('domain')->get();

        $this->assertCount(1, $hostingPackages);
        $this->assertEquals('Hosting Package', $hostingPackages->first()->name);
        $this->assertCount(1, $domainPackages);
        $this->assertEquals('Domain Package', $domainPackages->first()->name);
    }

    public function test_formatted_price_attribute(): void
    {
        $package = $this->createPackage(['price' => 2500.50, 'currency' => 'ETB']);

        $this->assertEquals('2,500.50 ETB', $package->formatted_price);
    }

    public function test_formatted_price_with_zero_decimals(): void
    {
        $package = $this->createPackage(['price' => 1000.00, 'currency' => 'USD']);

        $this->assertEquals('1,000.00 USD', $package->formatted_price);
    }

    public function test_package_has_many_orders_relationship(): void
    {
        $package = $this->createPackage();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $package->orders());
    }

    public function test_fillable_attributes(): void
    {
        $package = new Package();
        $expected = ['name', 'description', 'price', 'currency', 'type', 'features', 'is_active'];

        $this->assertEquals($expected, $package->getFillable());
    }
}
