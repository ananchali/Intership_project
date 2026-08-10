#!/bin/bash

# Cache configurations
php artisan config:cache
php artisan view:cache

# Run database migrations and seed only if the database is reachable,
# so the web server still boots (and shows a friendly error) when the
# DB is temporarily unavailable.
if php -r '
    $dsn = getenv("MONGODB_DSN");
    $opts = array_filter(["username" => getenv("MONGODB_USERNAME"), "password" => getenv("MONGODB_PASSWORD")]);
    try {
        (new MongoDB\Driver\Manager($dsn, $opts))->executeCommand("admin", new MongoDB\Driver\Command(["ping" => 1]));
        exit(0);
    } catch (Throwable $e) {
        exit(1);
    }
'; then
    php artisan migrate --force
    php artisan db:seed --force
else
    echo "WARNING: MongoDB unreachable - skipping migrations and seeding"
fi

# Replace Nginx port if $PORT is defined by Render
if [ -n "$PORT" ]; then
    sed -i "s/listen 80;/listen $PORT;/g" /etc/nginx/sites-available/default
fi

# Start PHP-FPM in the background
php-fpm -D

# Start Nginx in the foreground
nginx -g "daemon off;"
