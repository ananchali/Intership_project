<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'business_id',
        'name',
        'icon',
        'account_number',
        'account_name',
        'instructions',
        'is_active',
        'applicable_to',
        'applicable_providers',
        'applicable_package_ids',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function getIconUrlAttribute(): string
    {
        return $this->icon ? asset('storage/' . $this->icon) : '';
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeForType($query, string $type, ?string $provider = null, ?int $packageId = null)
    {
        return $query->where(function ($q) use ($type, $provider) {
            $q->where('applicable_to', 'all')
              ->orWhere('applicable_to', 'like', $type)
              ->orWhere('applicable_to', 'like', $type . ',%')
              ->orWhere('applicable_to', 'like', '%,' . $type)
              ->orWhere('applicable_to', 'like', '%,' . $type . ',%');
        })->when($provider && $type === 'services', function ($q) use ($provider) {
            $q->where(function ($sub) use ($provider) {
                $sub->whereNull('applicable_providers')
                     ->orWhere('applicable_providers', '')
                     ->orWhere('applicable_providers', 'like', $provider)
                     ->orWhere('applicable_providers', 'like', $provider . ',%')
                     ->orWhere('applicable_providers', 'like', '%,' . $provider)
                     ->orWhere('applicable_providers', 'like', '%,' . $provider . ',%');
            });
        })->when($packageId, function ($q) use ($packageId) {
            $q->where(function ($sub) use ($packageId) {
                $sub->whereNull('applicable_package_ids')
                     ->orWhere('applicable_package_ids', '')
                     ->orWhere('applicable_package_ids', 'like', (string) $packageId)
                     ->orWhere('applicable_package_ids', 'like', $packageId . ',%')
                     ->orWhere('applicable_package_ids', 'like', '%,' . $packageId)
                     ->orWhere('applicable_package_ids', 'like', '%,' . $packageId . ',%');
            });
        });
    }
}
