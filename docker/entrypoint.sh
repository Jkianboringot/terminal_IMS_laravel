#!/usr/bin/env bash
set -e

cd /var/www

# 🔁 Ensure folders always exist (Render sometimes overwrites them)
mkdir -p storage/framework/{cache,sessions,views}
mkdir -p bootstrap/cache

# 🔒 Set correct permissions
chmod -R 775 storage bootstrap/cache || true
chown -R www-data:www-data storage bootstrap/cache || true

# ⚙ Laravel bootstrap (ignore errors)
if [ -f artisan ]; then
  php artisan config:clear || true
  php artisan config:cache || true
  php artisan route:cache || true
  php artisan view:cache || true
  php artisan package:discover --ansi || true
fi

# ▶ Run CMD
exec "$@"
