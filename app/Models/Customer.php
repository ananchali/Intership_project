<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const ROLE_CUSTOMER = 'customer';
    const ROLE_BUSINESS_OWNER = 'business_owner';
    const ROLE_SUPER_ADMIN = 'super_admin';

    protected $table = 'customers';
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'phone_verified_at',
        'password_hash',
        'is_active',
        'role',
        'business_id',
    ];

    protected $hidden = [
        'password_hash',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function getAuthPasswordName()
    {
        return 'password_hash';
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function payments()
    {
        return $this->hasManyThrough(Payment::class, Order::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPER_ADMIN;
    }

    public function isBusinessOwner(): bool
    {
        return $this->role === self::ROLE_BUSINESS_OWNER;
    }

    public function isAdmin(): bool
    {
        return $this->isSuperAdmin() || $this->isBusinessOwner();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
