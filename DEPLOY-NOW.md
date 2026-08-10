# ?? Deploy Laravel to Vercel - Quick Start

## Files Created for You:
1. `vercel.json` - Vercel configuration
2. `api/index.php` - Serverless entry point
3. `.env.vercel` - Production environment template
4. `composer.json` - Added vercel-build script
5. `.gitignore` - Updated to exclude Vercel configs

## ?? Step-by-Step Deployment:

### 1. Generate APP_KEY (if not done)
```bash
php artisan key:generate --show
# Copy the output - you will need it for Vercel
```

### 2. Set Up External Database

**Recommended: PlanetScale (Free tier available)**
1. Sign up at https://planetscale.com
2. Create a new database (e.g., `afronexhosting`)
3. Note down: Host, Database name, Username, Password

### 3. Push Code to GitHub
```bash
git init
git add .
git commit -m "Prepare for Vercel deployment"
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git
git push -u origin main
```

### 4. Deploy on Vercel

**Option A: Via Vercel Dashboard (Easiest)**
1. Go to https://vercel.com/new
2. Import your GitHub repository
3. Click "Deploy"
4. Wait for build to complete

**Option B: Via Vercel CLI**
```bash
npm i -g vercel
vercel login
vercel --prod
```

### 5. Configure Environment Variables in Vercel

Go to: **Vercel Dashboard ? Your Project ? Settings ? Environment Variables**

Add these variables (replace with your actual values):

```envn
# Critical - Must have these!
APP_KEY=base64:YOUR_KEY_FROM_STEP_1
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-project.vercel.app

# Database (PlanetScale example)
DB_CONNECTION=mysql
DB_HOST=aws.connect.psdb.cloud
DB_PORT=3306
DB_DATABASE=afronexhosting
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Session & Cache (use database for production)
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=sync

# Mail (optional - configure later)
MAIL_MAILER=log
MAIL_FROM_ADDRESS=hello@afronexhosting.com
MAIL_FROM_NAME="AfronexHosting"

# File Storage (optional - configure later)
FILESYSTEM_DISK=local
```

**Important:** Select "Production" environment when adding variables!

### 6. Run Database Migrations

```bash
# Pull Vercel environment variables locally
vercel env pull .env.vercel

# Update .env.vercel with your database credentials
# Then run migrations:
php artisan migrate --force --env=production
```

Or use Vercel CLI:
```bash
vercel exec php artisan migrate --force
```

### 7. Import Existing Data (if any)

If you have existing data:
```bash
# Export from local SQLite
echo ".dump" | sqlite3 database/database.sqlite > local_data.sql

# Convert and import to MySQL (requires sqlite3-to-mysql tool)
# Or use a migration script
```

### 8. Test Your Deployment

Visit: https://your-project.vercel.app

Check these:
- [ ] Homepage loads
- [ ] User registration works
- [ ] Login works
- [ ] Admin panel accessible
- [ ] Orders can be placed
- [ ] File uploads work (if configured)

## ?? Post-Deployment Configuration

### Configure File Storage (If Needed)

**AWS S3:**
1. Create S3 bucket
2. Create IAM user with S3 permissions
3. Add to Vercel env vars:
```env
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=AKIAIOSFODNN7EXAMPLE
AWS_SECRET_ACCESS_KEY=wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=your-bucket-name
AWS_URL=https://your-bucket.s3.amazonaws.com
```

**Cloudflare R2 (Free alternative):**
1. Create R2 bucket
2. Generate API tokens
3. Add to Vercel env vars:
```env
FILESYSTEM_DISK=s3
AWS_ACCESS_KEY_ID=your_r2_access_key
AWS_SECRET_ACCESS_KEY=your_r2_secret_key
AWS_DEFAULT_REGION=auto
AWS_BUCKET=your-bucket-name
AWS_ENDPOINT=https://your-account-id.r2.cloudflarestorage.com
```

### Configure Email (If Needed)

**Mailgun (Recommended for production):**
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.com
MAILGUN_SECRET=your-mailgun-api-key
MAIL_FROM_ADDRESS=noreply@your-domain.com
```

**Or use SMTP:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
```

## ?? Common Issues

### Issue: "No application encryption key"
**Fix:** Set APP_KEY in Vercel environment variables
```bash
php artisan key:generate --show
```

### Issue: Database connection error
**Fix:**
- Check database host, port, username, password
- Ensure database allows connections from Vercel IPs (use 0.0.0.0/0)
- Verify database exists

### Issue: 404 on all routes
**Fix:** vercel.json routes all requests to /api/index.php - this is correct!

### Issue: File uploads fail
**Fix:** Configure S3/R2 storage (see above)

### Issue: Sessions don't persist
**Fix:** Use database sessions:
```env
SESSION_DRIVER=database
```
Then run: `php artisan session:table && php artisan migrate`

## ?? Important Notes

1. **Vercel is serverless** - Files don't persist between requests
2. **Use external database** - SQLite won't work
3. **Use S3/R2 for uploads** - Local storage won't persist
4. **Cold starts** - First request may be slow (5-10 seconds)
5. **Execution time** - Max 60 seconds on Pro plan, 10s on Hobby

## ?? Monitoring

- View logs: Vercel Dashboard ? Your Project ? Logs
- Monitor performance: Vercel Analytics
- Error tracking: Consider Sentry.io

## ?? Redeploying

Whenever you make changes:
```bash
git add .
git commit -m "Update"
git push
# Vercel auto-deploys!
```

## ?? Cost Estimate

**Vercel Hobby (Free):**
- 100GB bandwidth/month
- Unlimited deployments
- Automatic SSL

**PlanetScale Hobby (Free):**
- 1 database
- 1GB storage
- 1 billion row reads/month

**Cloudflare R2 (Free):**
- 10GB storage
- 10 million reads/month

**Total: $0/month** for small to medium apps!

## ?? Next Steps

1. ? Deploy to Vercel
2. ? Configure database
3. ? Set up file storage
4. ? Configure email
5. ? Test all features
6. ? Set up custom domain (optional)
7. ? Enable Vercel Analytics
8. ? Set up error monitoring

## ?? Resources

- [Vercel Docs](https://vercel.com/docs)
- [Laravel Deployment](https://laravel.com/docs/deployment)
- [PlanetScale Docs](https://planetscale.com/docs)

## ?? Need Help?

Check Vercel deployment logs for errors:
1. Go to Vercel Dashboard
2. Click on your deployment
3. Check "Build Logs" and "Function Logs"
