# Stage 1 - Node for frontend build
FROM node:20 AS node-builder

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install

COPY . ./
RUN npm run build


# Stage 2 - PHP + Laravel Setup
FROM php:8.2-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# App directory
WORKDIR /var/www

# Copy app code
COPY . .

# Use production .env
COPY .env.production .env

# Copy built assets
COPY --from=node-builder /app/public/build ./public/build

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Laravel prep
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache \
 && chown -R www-data:www-data /var/www \
 && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Expose Laravel port
EXPOSE 8000

# Run migrations and start app
CMD php artisan migrate --seed --force && php artisan serve --host=0.0.0.0 --port=8000
