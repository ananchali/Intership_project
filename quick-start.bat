@echo off
echo Setting up Payment Verification System...
echo.

if not exist .env (
    echo Step 1: Creating environment file...
    copy .env.example .env >nul 2>&1
    php artisan key:generate
) else (
    echo Step 1: Environment file already exists, keeping it.
)

echo Step 2: Running database migrations...
php artisan migrate --force

echo Step 3: Seeding database...
php artisan db:seed --force

echo Step 4: Starting development server...
echo.
echo ========================================
echo Payment Verification System is ready!
echo Visit: http://localhost:8000
echo Admin Dashboard: http://localhost:8000/admin/dashboard
echo Press Ctrl+C to stop the server
echo ========================================
echo.

php artisan serve
