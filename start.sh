#!/bin/bash

# Map Render's DATABASE_URL to Laravel's expected DB_URL
if [ -n "$DATABASE_URL" ]; then
    export DB_URL="$DATABASE_URL"
fi

# Cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
php artisan migrate --force

# Replace Nginx port if $PORT is defined by Render
if [ -n "$PORT" ]; then
    sed -i "s/listen 80;/listen $PORT;/g" /etc/nginx/sites-available/default
fi

# Start PHP-FPM in the background
php-fpm -D

# Start Nginx in the foreground
nginx -g "daemon off;"
