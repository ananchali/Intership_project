<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Package extends Model
{
    
    protected $fillable = [
        'business_id',
        'name',
        'description',
        'price',
        'registration_fee',
        'monthly_fee',
        'currency',
        'type',
        'provider',
        'features',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'registration_fee' => 'decimal:2',
        'monthly_fee' => 'decimal:2',
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2) . ' ' . $this->currency;
    }
}
