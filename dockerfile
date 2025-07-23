FROM php:8.2-fpm AS app

# --- 1. Install system dependencies ---
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
 && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
 && rm -rf /var/lib/apt/lists/*

# --- 2. Install Composer ---
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# --- 3. Set working dir ---
WORKDIR /var/www

# --- 4. Copy all app files before .env and entrypoint ---
COPY . .

# --- 5. Copy production env file ---
RUN cp .env.production .env || true

# --- 6. Pre-create storage dirs for Laravel ---
RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache

# --- 7. Set proper permissions ---
RUN chown -R www-data:www-data /var/www \
 && chmod -R ug+rwx storage bootstrap/cache

# --- 8. Install PHP dependencies (no scripts!) ---
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --no-scripts

# --- 9. Copy and prepare entrypoint ---
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# --- 10. Set runtime user ---
USER www-data

# --- 11. Entrypoint and CMD ---
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
