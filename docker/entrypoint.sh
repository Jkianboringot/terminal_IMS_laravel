#!/usr/bin/env bash
set -e

cd /var/www

# Ensure storage and cache directories exist
mkdir -p storage/framework/{cache,sessions,views}
mkdir -p bootstrap/cache

# Fix permissions (ignore errors if already owned)
chmod -R 775 storage bootstrap/cache || true
chown -R www-data:www-data storage bootstrap/cache || true

# Clear & rebuild Laravel caches
php artisan config:clear || true
php artisan config:cache || true
php artisan route:clear || true
php artisan route:cache || true
php artisan view:clear || true
php artisan view:cache || true

# Finally exec the container CMD (php-fpm)
exec "$@"
php artisan serve --host=0.0.0.0 --port=${PORT}

