# Deploying AfronexHosting to Vercel

## What Has Been Set Up

Your Laravel application has been configured for Vercel deployment with the following files:

### Configuration Files Created:
1. **`vercel.json`** - Vercel deployment configuration
   - Routes all requests through serverless function
   - Builds PHP and static assets
   - Sets production environment

2. **`api/index.php`** - Serverless function entry point
   - Bootstraps Laravel for Vercel's serverless environment
   - Uses /tmp for temporary storage
   - Handles HTTP requests

3. **`.env.vercel`** - Production environment template
   - All required environment variables for production
   - Database, mail, storage configuration

4. **`composer.json`** - Added build script
   - `vercel-build` script for optimized production builds
   - Caches config, routes, and views

5. **`deploy.ps1`** - Automated deployment script (Windows)
   - Checks Vercel CLI
   - Generates APP_KEY
   - Builds assets
   - Deploys to Vercel

6. **`DEPLOY-NOW.md`** - Complete deployment guide
   - Step-by-step instructions
   - Troubleshooting tips
   - Post-deployment checklist

## Quick Start (3 Steps)

### Step 1: Prepare Database

Sign up for a free database:
- **PlanetScale**: https://planetscale.com (MySQL, free tier)
- **Neon**: https://neon.tech (PostgreSQL, free tier)

Create a database and note the credentials.

### Step 2: Deploy to Vercel

**Option A: Using Deployment Script (Recommended)**
```powershell
# Run the automated deployment script
.\deploy.ps1
```

**Option B: Manual Deployment**
```bash
# 1. Push to GitHub

git init
git add .
git commit -m "Deploy to Vercel"
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git
git push -u origin main

# 2. Deploy on Vercel
# Go to https://vercel.com/new and import your repo
```

### Step 3: Configure Environment Variables

In Vercel Dashboard ? Settings ? Environment Variables, add:

**Required:**
```env
APP_KEY=base64:GENERATED_KEY_HERE
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.vercel.app

DB_CONNECTION=mysql
DB_HOST=your-db-host.com
DB_PORT=3306
DB_DATABASE=your_db_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local
MAIL_MAILER=log
```

**Generate APP_KEY:**
```bash
php artisan key:generate --show
```

## Important Changes from Local Development

| Feature | Local (SQLite) | Production (Vercel) |
|---------|---------------|---------------------|
| Database | SQLite file | PlanetScale/Neon (MySQL/PostgreSQL) |
| Sessions | File-based | Database |
| File Storage | Local disk | S3/R2 (optional) |
| Cache | File-based | Database/Redis |

**Why?** Vercel's serverless environment has no persistent file storage.

## Run Database Migrations

```bash
# Install Vercel CLI
npm i -g vercel

# Pull environment variables
vercel env pull .env.vercel

# Update .env.vercel with your database credentials
# Then run migrations:
php artisan migrate --force --env=production
```

## Verify Deployment

1. Visit your Vercel URL: `https://your-project.vercel.app`
2. Test user registration/login
3. Test admin panel
4. Test order placement
5. Check Vercel logs for errors

## Common Issues

### "No application encryption key"
? Set APP_KEY in Vercel environment variables

### Database connection failed
? Check credentials, ensure database allows remote connections

### 404 on all routes
? This is normal - vercel.json routes everything through /api/index.php

### File uploads not working
? Configure S3 or R2 storage (see DEPLOY-NOW.md)

## File Structure

```
project/
+-- vercel.json          # Vercel config (DO NOT commit)
+-- vercel.json.example   # Example config (commit this)
+-- api/
¦   +-- index.php        # Serverless entry point
+-- .env.vercel          # Production env vars (DO NOT commit)
+-- deploy.ps1           # Deployment script
+-- DEPLOY-NOW.md        # Detailed guide
```

## What NOT to Commit

These files are in `.gitignore` and should NOT be committed:
- `.env` (local environment)
- `.env.vercel` (production secrets)
- `vercel.json` (may contain project-specific config)
- `vendor/` (composer packages)
- `node_modules/` (npm packages)

## Next Steps

1. ? Push code to GitHub
2. ? Deploy on Vercel
3. ? Configure environment variables
4. ? Set up external database
5. ? Run migrations
6. ? Configure file storage (S3/R2)
7. ? Configure email service
8. ? Test all features
9. ? Set up custom domain (optional)

## Resources

- **DEPLOY-NOW.md** - Complete deployment guide with troubleshooting
- **.env.vercel** - Template for production environment variables
- **Vercel Docs**: https://vercel.com/docs
- **Laravel Deployment**: https://laravel.com/docs/deployment

## Support

If you encounter issues:
1. Check Vercel deployment logs
2. Enable APP_DEBUG=true temporarily
3. Check Laravel logs in storage/logs
4. Review DEPLOY-NOW.md for troubleshooting

---

**Your app will be live at:** `https://your-project.vercel.app`
