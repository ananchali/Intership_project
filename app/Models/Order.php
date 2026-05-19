<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    
    protected $fillable = [
        'order_number',
        'package_id',
        'domain_name',
        'domain_type',
        'status',
        'total_amount',
        'currency',
        'customer_details',
        'payment_method',
        'customer_id',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'customer_details' => 'array',
        'customer_id' => 'string',
        'package_id' => 'string',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function paymentVerifications()
    {
        return $this->hasManyThrough(PaymentVerification::class, Payment::class);
    }

    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopeByCustomer(Builder $query, string $customerId): Builder
    {
        return $query->where('customer_id', $customerId);
    }

    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->total_amount, 2) . ' ' . $this->currency;
    }

    public static function generateOrderNumber(): string
    {
        $latest = static::orderBy('created_at', 'desc')->first();
        $number = $latest ? ((int) substr($latest->order_number, -6) + 1) : 1;
        return 'ORD-' . date('Y') . '-' . str_pad($number, 6, '0', STR_PAD_LEFT);
    }
}
