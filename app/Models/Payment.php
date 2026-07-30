<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
    
    protected $fillable = [
        'order_id',
        'amount',
        'currency',
        'payment_method',
        'bank_name',
        'transaction_reference',
        'payment_date',
        'status',
        'verification_notes',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'verified_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function verification()
    {
        return $this->hasOne(PaymentVerification::class);
    }

    public function verifiedByUser()
    {
        return $this->belongsTo(Customer::class, 'verified_by');
    }

    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount, 2) . ' ' . $this->currency;
    }

    public function markAsVerified(string $notes = null, string $verifiedBy = null): void
    {
        $this->update([
            'status' => 'verified',
            'verification_notes' => $notes,
            'verified_by' => $verifiedBy,
            'verified_at' => now(),
        ]);
    }

    public function markAsRejected(string $notes = null, string $verifiedBy = null): void
    {
        $this->update([
            'status' => 'rejected',
            'verification_notes' => $notes,
            'verified_by' => $verifiedBy,
            'verified_at' => now(),
        ]);
    }
}
