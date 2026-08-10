# Quick Setup Guide - Payment Verification System

## Current Database: MongoDB (installed and working)

MongoDB Community Server 8.3 is installed as a Windows service and the app is connected to it.

- **Connection:** `mongodb://127.0.0.1:27017`
- **Database:** `payment_verification`
- **MongoDB Compass:** open `mongodb://127.0.0.1:27017`, see the `payment_verification` database (collections = tables, e.g. `packages`, `customers`, `orders`, `payments`, `businesses`, `users`)
- **Service:** run `net start MongoDB` / `net stop MongoDB` if it is stopped

## Setup Steps (already done on this PC — reference for later/new machines)

1. **PHP MongoDB extension** (`php_mongodb.dll`, v2.3.3 for PHP 8.3 NTS x64):
   - Downloaded from `https://windows.php.net/downloads/pecl/releases/mongodb/2.3.3/php_mongodb-2.3.3-8.3-nts-vs16-x64.zip`
   - Copied to `C:\Users\Administrator\AppData\Local\Programs\PHP\8.3\ext\php_mongodb.dll`
   - Enabled in `php.ini` with `extension=mongodb`
   - Verify: `php -m` should list `mongodb` and `php -r "echo phpversion('mongodb');"` prints `2.3.3`

2. **Laravel package:**
   ```bash
   php composer.phar require mongodb/laravel-mongodb
   ```
   Installed `mongodb/laravel-mongodb` 5.9.1 + `mongodb/mongodb` 2.3.0.

3. **Models must extend MongoDB base classes** (already done):
   - Regular models: `use MongoDB\Laravel\Eloquent\Model;` (instead of `Illuminate\Database\Eloquent\Model`)
   - Auth models (User, Customer): `use MongoDB\Laravel\Auth\User as Authenticatable;`

4. **`.env` config:**
   ```env
   DB_CONNECTION=mongodb
   MONGODB_DSN=mongodb://127.0.0.1:27017
   MONGODB_DATABASE=payment_verification
   ```

5. **Migrations:** run with:
   ```bash
   php artisan migrate --force
   php artisan db:seed --force   # seeds 18 packages
   ```
   Note: SQL-only `->after(...)` column-ordering chains were removed from migrations (they crash the MongoDB Blueprint in Laravel 13) and `morphs('tokenable')` was replaced with plain `string` columns in the personal access tokens migration.

## Start the app

```bash
php artisan serve
# or use quick-start.bat (now keeps MongoDB, does not overwrite .env)
```

Visit: http://localhost:8000

## Useful pages

- Homepage / packages: http://localhost:8000/packages
- Admin dashboard: http://localhost:8000/admin/dashboard

## Optional: switch back to SQLite

Edit `.env`:
```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```
The sqlite file is still on disk but no longer used.

## Test Data Included

- 18 sample packages (hosting, domain, services grouped by provider)
- Ethiopian bank options
- Complete workflow ready for testing
