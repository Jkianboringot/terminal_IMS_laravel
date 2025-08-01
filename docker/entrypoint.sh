#!/bin/bash

# Clear old caches
php artisan config:clear
php artisan config:cache

# Run DB migrations
php artisan migrate --force
php artisan db:seed --force


# Start Laravel
exec "$@"
