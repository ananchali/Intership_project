<?php

namespace App\Services;

use App\Models\PhoneVerification;
use Illuminate\Support\Facades\Log;

class OtpService
{
    const OTP_LENGTH = 6;
    const OTP_EXPIRY_MINUTES = 5;

    public function generate(string $phone): PhoneVerification
    {
        // Invalidate any existing pending OTPs for this phone
        PhoneVerification::where('phone', $phone)
            ->whereNull('used_at')
            ->update(['used_at' => now()]);

        $otp = $this->generateOtp();

        $verification = PhoneVerification::create([
            'phone'      => $phone,
            'otp'        => $otp,
            'expires_at' => now()->addMinutes(self::OTP_EXPIRY_MINUTES),
        ]);

        $this->sendOtp($phone, $otp);

        return $verification;
    }

    public function verify(string $phone, string $otp): bool
    {
        $record = PhoneVerification::pendingForPhone($phone)->latest()->first();

        if (!$record || $record->otp !== $otp) {
            return false;
        }

        $record->markAsUsed();
        return true;
    }

    private function generateOtp(): string
    {
        return str_pad((string) random_int(0, 999999), self::OTP_LENGTH, '0', STR_PAD_LEFT);
    }

    private function sendOtp(string $phone, string $otp): void
    {
        // Log OTP to file (SMS integration placeholder)
        Log::channel('otp')->info("OTP for {$phone}: {$otp}");
    }
}
