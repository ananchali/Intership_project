@echo off
echo Setting up Payment Verification System...
echo.

echo Step 1: Copying environment file...
copy .env.example .env >nul 2>&1

echo Step 2: Setting up SQLite database...
powershell -Command "(Get-Content .env) -replace 'DB_CONNECTION=mongodb', 'DB_CONNECTION=sqlite' | Set-Content .env"

echo Step 3: Creating database...
php artisan db:seed

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
