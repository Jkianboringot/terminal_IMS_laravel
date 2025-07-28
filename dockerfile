# --------------------------------------
# STAGE 1: Build Composer dependencies
# --------------------------------------
FROM composer:2.7 as composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-scripts

# --------------------------------------
# STAGE 2: Build Node assets
# --------------------------------------
FROM node:20-alpine as node

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm install && npm run build

# --------------------------------------
# STAGE 3: Laravel production image
# --------------------------------------
FROM php:8.1-fpm-alpine

# Install system packages
RUN apk add --no-cache \
    bash \
    git \
    unzip \
    libzip-dev \
    icu-dev \
    zlib-dev \
    libpng-dev \
    freetype-dev \
    oniguruma-dev \
    mysql-client \
    curl \
    libjpeg-turbo-dev

# PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    intl \
    bcmath

# Set working directory
WORKDIR /var/www

# Copy source code
COPY . .

# Copy built assets and vendor deps
COPY --from=composer /app/vendor ./vendor
COPY --from=node /app/public ./public

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache && chown -R www-data:www-data .

# Laravel web entry point
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
