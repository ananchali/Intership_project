<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneVerification extends Model
{
    protected $fillable = [
        'phone',
        'otp',
        'expires_at',
        'used_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    public function scopePendingForPhone($query, string $phone)
    {
        return $query->where('phone', $phone)
            ->whereNull('used_at')
            ->where('expires_at', '>', now());
    }

    public function isValid(): bool
    {
        return is_null($this->used_at) && $this->expires_at->isFuture();
    }

    public function markAsUsed(): void
    {
        $this->update(['used_at' => now()]);
    }
}
