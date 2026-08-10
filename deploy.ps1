# Vercel Deployment Script for Laravel
# Run this script to prepare and deploy your Laravel app to Vercel

Write-Host "===============================================" -ForegroundColor Cyan
Write-Host "  Laravel to Vercel Deployment Script" -ForegroundColor Cyan
Write-Host "===============================================" -ForegroundColor Cyan
Write-Host ""

# Check if Vercel CLI is installed
Write-Host "[1/5] Checking Vercel CLI..." -ForegroundColor Yellow
$vercelInstalled = Get-Command vercel -ErrorAction SilentlyContinue
if (-not $vercelInstalled) {
    Write-Host "Installing Vercel CLI..." -ForegroundColor Yellow
    npm i -g vercel
} else {
    Write-Host "Vercel CLI is installed ?" -ForegroundColor Green
}

# Check if user is logged in to Vercel
Write-Host ""
Write-Host "[2/5] Checking Vercel authentication..." -ForegroundColor Yellow
$whoami = vercel whoami 2>&1
if ($LASTEXITCODE -ne 0) {
    Write-Host "Please log in to Vercel..." -ForegroundColor Yellow
    vercel login
} else {
    Write-Host "Logged in as: $whoami" -ForegroundColor Green
}

# Generate APP_KEY if not exists
Write-Host ""
Write-Host "[3/5] Checking APP_KEY..." -ForegroundColor Yellow
$appKey = php artisan key:generate --show 2>&1
if ($appKey -match "base64:") {
    Write-Host "APP_KEY generated ?" -ForegroundColor Green
    Write-Host "IMPORTANT: Copy this APP_KEY and add it to Vercel environment variables:" -ForegroundColor Cyan
    Write-Host $appKey -ForegroundColor White
    Write-Host ""
    $addKey = Read-Host "Do you want to add this to .env.vercel now? (y/n)"
    if ($addKey -eq "y") {
        (Get-Content .env.vercel) -replace "APP_KEY=base64:YOUR_APP_KEY_HERE", "APP_KEY=$appKey" | Set-Content .env.vercel
        Write-Host "APP_KEY updated in .env.vercel ?" -ForegroundColor Green
    }
}

# Build assets
Write-Host ""
Write-Host "[4/5] Building assets..." -ForegroundColor Yellow
if (-not (Test-Path node_modules)) {
    Write-Host "Installing npm dependencies..." -ForegroundColor Yellow
    npm install --ignore-scripts
}
Write-Host "Building Vite assets..." -ForegroundColor Yellow
npm run build
Write-Host "Assets built ?" -ForegroundColor Green

# Deploy to Vercel
Write-Host ""
Write-Host "[5/5] Ready to deploy!" -ForegroundColor Green
Write-Host ""
Write-Host "===============================================" -ForegroundColor Cyan
Write-Host "  Next Steps:" -ForegroundColor Cyan
Write-Host "===============================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "1. Add environment variables in Vercel Dashboard:" -ForegroundColor White
Write-Host "   https://vercel.com/new (or use existing project)" -ForegroundColor Gray
Write-Host ""
Write-Host "2. Required environment variables (see .env.vercel):" -ForegroundColor White
Write-Host "   - APP_KEY (generated above)" -ForegroundColor Gray
Write-Host "   - Database credentials (from PlanetScale/Neon)" -ForegroundColor Gray
Write-Host "   - Other production settings" -ForegroundColor Gray
Write-Host ""
Write-Host "3. Deploy to Vercel:" -ForegroundColor White
$deployNow = Read-Host "Do you want to deploy now? (y/n)"
if ($deployNow -eq "y") {
    Write-Host ""
    Write-Host "Deploying to Vercel..." -ForegroundColor Yellow
    vercel --prod
}

Write-Host ""
Write-Host "Deployment script completed!" -ForegroundColor Green
