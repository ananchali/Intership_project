<?php

namespace App\Console\Commands;

use App\Models\Customer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CreateAdminCommand extends Command
{
    protected $signature = 'admin:create
        {--email= : Admin email address}
        {--name= : Admin display name}
        {--password= : Admin password (at least 12 characters)}
        {--phone= : Optional phone number. Leave empty to allow login without OTP}';

    protected $description = 'Create or update a super admin account';

    public function handle(): int
    {
        $email = $this->option('email') ?? $this->ask('Admin email');
        $name = $this->option('name') ?? $this->ask('Admin name', 'Admin User');

        $password = $this->option('password');
        if ($password === null) {
            $password = $this->secret('Admin password (at least 12 characters)');
        }

        if (strlen((string) $password) < 12) {
            $this->error('Password must be at least 12 characters long.');
            return self::FAILURE;
        }

        $phone = $this->option('phone');
        if ($phone === null) {
            $phone = $this->ask('Phone number (optional, empty to skip OTP)', '');
        }
        $phone = $phone === '' ? null : $phone;

        $validator = Validator::make([
            'email' => $email,
            'name' => $name,
        ], [
            'email' => ['required', 'email'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return self::FAILURE;
        }

        $admin = Customer::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'phone' => $phone,
                'phone_verified_at' => $phone ? now() : null,
                'password_hash' => Hash::make($password),
                'is_active' => true,
                'role' => Customer::ROLE_SUPER_ADMIN,
            ]
        );

        $message = $admin->wasRecentlyCreated
            ? "Super admin created: {$email}"
            : "Super admin updated: {$email}";

        $this->info($message);

        if ($phone === null) {
            $this->warn('No phone set — this admin logs in without OTP.');
        }

        return self::SUCCESS;
    }
}