#!/usr/bin/env bash
set -e

cd /var/www

# 🔧 Create storage & bootstrap cache folders if missing
mkdir -p storage/framework/{cache,sessions,views}
mkdir -p bootstrap/cache

# 🔐 Fix permissions (important for both dev & production)
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# ⚡ Laravel bootstrap (allow errors so build doesn't fail)
if [ -f artisan ]; then
  php artisan config:clear || true
  php artisan config:cache || true
  php artisan route:cache || true
  php artisan view:cache || true
  php artisan package:discover --ansi || true
fi

# 🟢 Run container's default CMD
exec "$@"
