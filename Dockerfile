FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    ca-certificates \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libssl-dev \
    libcurl4-openssl-dev \
    libsasl2-dev \
    libzip-dev \
    pkg-config \
    zip \
    unzip \
    nginx \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd zip

# Install MongoDB extension (required for Laravel MongoDB / Atlas)
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Node.js 22 (bookworm's apt "nodejs" is Node 18, too old for Vite 8)
ARG NODE_MAJOR=22
RUN curl -fsSL https://deb.nodesource.com/setup_${NODE_MAJOR}.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Production PHP settings
RUN { \
        echo 'memory_limit = 256M'; \
        echo 'upload_max_filesize = 10M'; \
        echo 'post_max_size = 12M'; \
        echo 'max_execution_time = 60'; \
        echo 'expose_php = Off'; \
    } > $PHP_INI_DIR/conf.d/99-production.ini

# Set working directory
WORKDIR /var/www

# Copy entire application (excluding junk via .dockerignore)
COPY . .

# Install PHP dependencies (no dev packages in production)
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-interaction --no-progress --prefer-dist --optimize-autoloader --no-dev

# Install Node dependencies and build Vite assets.
# --ignore-scripts=false overrides the repo root ".npmrc" which disables scripts.
RUN npm ci --no-audit --no-fund --ignore-scripts=false \
    && npm run build

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/sites-available/default

# Copy start script and make it executable
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Set correct permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

CMD ["/usr/local/bin/start.sh"]