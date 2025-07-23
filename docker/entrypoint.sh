#!/usr/bin/env bash
set -e

cd /var/www

# Ensure storage dirs are writable every start (important if volumes override)
mkdir -p storage/framework/{cache,sessions,views} bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache

# Laravel bootstrap steps (skip errors to avoid build crash)
php artisan config:cache --no-interaction || true
php artisan route:cache --no-interaction || true
php artisan view:cache --no-interaction || true
php artisan package:discover --ansi --no-interaction || true

# Start the container command (e.g. php-fpm)
exec "$@"
