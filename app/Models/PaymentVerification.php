<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class PaymentVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'order_id',
        'bank_slip_path',
        'customer_name',
        'transaction_reference',
        'payment_date',
        'bank_name',
        'additional_notes',
        'status',
        'admin_notes',
        'processed_by',
        'processed_at',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'payment_date' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function processedByUser()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function getBankSlipUrlAttribute()
    {
        if (!$this->bank_slip_path) return null;
        
        $path = $this->bank_slip_path;
        if (str_starts_with($path, 'public/')) {
            $path = str_replace('public/', '', $path);
        }

        return asset('storage/' . $path);
    }

    /**
     * Scopes
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    /**
     * Helpers
     */
    public function approve(?string $notes = null, ?int $processedBy = null): void
    {
        $this->update([
            'status' => 'approved',
            'admin_notes' => $notes,
            'processed_by' => $processedBy,
            'processed_at' => now(),
        ]);
    }

    public function reject(string $notes, ?int $processedBy = null): void
    {
        $this->update([
            'status' => 'rejected',
            'admin_notes' => $notes,
            'processed_by' => $processedBy,
            'processed_at' => now(),
        ]);
    }
}

