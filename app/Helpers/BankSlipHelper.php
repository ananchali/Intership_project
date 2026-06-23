<?php

namespace App\Helpers;

class BankSlipHelper
{
    /**
     * Normalize a bank slip path by stripping the 'public/' prefix if present.
     */
    public static function normalizePath(string $path): string
    {
        if (str_starts_with($path, 'public/')) {
            return substr($path, strlen('public/'));
        }

        return $path;
    }

    /**
     * Get the absolute storage path for a bank slip.
     */
    public static function storagePath(string $path): string
    {
        return storage_path('app/public/' . static::normalizePath($path));
    }

    /**
     * Get the public URL for a bank slip.
     */
    public static function publicUrl(string $path): string
    {
        return asset('storage/' . static::normalizePath($path));
    }
}
