#!/usr/bin/env bash
set -u

echo "Bootstrapping Laravel (env: ${APP_ENV:-production}) at $(date -u +%FT%TZ)"

# Cache configuration and views for production.
# Routes are NOT cached because this app uses closure-based routes.
php artisan config:cache
php artisan view:cache

# Ensure the public/storage symlink exists so uploaded media is served.
php artisan storage:link >/dev/null 2>&1 || true

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
    echo "MongoDB reachable - running migrations and seeders"
    php artisan migrate --force
    php artisan db:seed --force
else
    echo "WARNING: MongoDB unreachable - skipping migrations and seeding"
fi

# Replace Nginx port if $PORT is defined by Render
if [ -n "${PORT:-}" ]; then
    sed -i "s/listen 80;/listen ${PORT};/g" /etc/nginx/sites-available/default
fi

# Start PHP-FPM in the background, then Nginx in the foreground
php-fpm -D
nginx -g "daemon off;"