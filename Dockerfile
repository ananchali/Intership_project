FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions required by Laravel and PostgreSQL
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . .

# Install PHP dependencies (ignore mongodb ext since we use PostgreSQL in production)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --ignore-platform-req=ext-mongodb

# Install Node dependencies and build Vite assets
RUN npm install && npm run build

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/sites-available/default

# Copy start script and make it executable
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Set correct permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port (Render sets the PORT environment variable)
EXPOSE 80

# Start script
CMD ["/usr/local/bin/start.sh"]
