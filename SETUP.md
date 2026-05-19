# Quick Setup Guide - Payment Verification System

## Option 1: Use SQLite (Easiest - No MongoDB Required)

If you want to test the system quickly without installing MongoDB, you can switch to SQLite:

1. **Update .env file:**
   ```env
   DB_CONNECTION=sqlite
   ```

2. **Create SQLite database:**
   ```bash
   php artisan db:seed
   ```

3. **Start server:**
   ```bash
   php artisan serve
   ```

## Option 2: Install MongoDB (Full System)

### Windows Installation:

1. **Download MongoDB Community Server:**
   - Go to: https://www.mongodb.com/try/download/community
   - Download Windows version
   - Run installer with default settings

2. **Add MongoDB to PATH:**
   - During installation, check "Install MongoDB as a Service"
   - Or manually add to PATH: `C:\Program Files\MongoDB\Server\7.0\bin`

3. **Start MongoDB Service:**
   ```bash
   net start MongoDB
   ```

4. **Test installation:**
   ```bash
   mongod --version
   ```

### After MongoDB is installed:

1. **Configure .env:**
   ```env
   DB_CONNECTION=mongodb
   MONGODB_DSN=mongodb://127.0.0.1:27017
   MONGODB_DATABASE=payment_verification
   ```

2. **Seed database:**
   ```bash
   php artisan db:seed
   ```

3. **Start server:**
   ```bash
   php artisan serve
   ```

## Quick Test (SQLite Method)

Let's get you running immediately with SQLite:

```bash
# 1. Switch to SQLite
echo "DB_CONNECTION=sqlite" >> .env

# 2. Seed database
php artisan db:seed

# 3. Start server
php artisan serve
```

Then visit: http://localhost:8000

## What You'll See:

1. **Homepage**: Package listing with hosting and domain options
2. **Order Flow**: Select package → Fill form → Submit order
3. **Payment Flow**: Upload bank slip → Enter details → Submit
4. **Admin Dashboard**: http://localhost:8000/admin/dashboard

## Test Data Included:

- 6 sample packages (3 hosting, 3 domain)
- Ethiopian bank options
- Complete workflow ready for testing
