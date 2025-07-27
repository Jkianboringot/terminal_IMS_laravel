# 1) Base PHP-FPM image
FROM php:8.2-fpm AS app

# 2) System dependencies + PHP extensions
RUN apt-get update \
 && apt-get install -y git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
 && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip \
 && rm -rf /var/lib/apt/lists/*

# 3) Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# 4) Set working directory
WORKDIR /var/www

# 5) Copy application files
COPY . .

# 6) Copy production env (if present)
RUN if [ -f .env.production ]; then cp .env.production .env; fi

# 7) Pre-create storage directories
RUN mkdir -p storage/framework/{sessions,views,cache} bootstrap/cache

# 8) Permissions
RUN chown -R www-data:www-data /var/www \
 && chmod -R ug+rwx storage bootstrap/cache

# 9) Install PHP dependencies & optimize
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# 10) Generate app key & cache configs
RUN php artisan key:generate --ansi \
 && php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# 11) Entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# 12) Switch to non‑root user
USER www-data

# 13) Expose PHP‑FPM port & launch
EXPOSE 9000
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
