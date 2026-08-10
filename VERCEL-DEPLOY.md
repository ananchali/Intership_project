# Deploying Laravel on Vercel

This guide explains how to deploy your Laravel 13 application on Vercel.

## Prerequisites

1. **Vercel Account** - Sign up at vercel.com
2. **GitHub/GitLab/Bitbucket Repository** - Push your code to a Git provider
3. **External Database** - You need a cloud database (choose one):
   - PlanetScale (MySQL)
   - Neon (PostgreSQL)
   - Railway (MySQL/PostgreSQL)
   - Supabase (PostgreSQL)
4. **Object Storage** (Optional but recommended for file uploads):
   - AWS S3
   - Cloudflare R2
   - DigitalOcean Spaces

## Quick Deployment Steps

### Step 1: Push to GitHub

```bash
git init
git add .
git commit -m "Initial commit with Vercel configuration"
git remote add origin https://github.com/your-username/your-repo.git
git push -u origin main
```

### Step 2: Deploy on Vercel

1. Go to vercel.com/new
2. Import your repository
3. Vercel will auto-detect Laravel and configure settings
4. Click Deploy

### Step 3: Configure Environment Variables

In your Vercel dashboard, go to Settings ? Environment Variables and add the variables from .env.vercel file.

Generate APP_KEY:
```bash
php artisan key:generate --show
```

### Step 4: Database Setup

1. Create a database on your chosen provider (PlanetScale, Neon, etc.)
2. Update .env.vercel with your database credentials
3. Run migrations:
```bash
vercel env pull .env.vercel
php artisan migrate --force
```

### Step 5: File Storage Setup

Configure S3 or R2 for file uploads:

#### AWS S3:
1. Create an S3 bucket
2. Create an IAM user with S3 access
3. Add credentials to Vercel environment variables

#### Cloudflare R2:
1. Create R2 bucket in Cloudflare dashboard
2. Generate API tokens
3. Add to Vercel environment variables

### Step 6: Deploy

```bash
# Install Vercel CLI
npm i -g vercel

# Deploy
vercel

# Or for production
vercel --prod
```
