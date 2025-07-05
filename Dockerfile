# syntax=docker/dockerfile:1

# --- Build Stage: Composer dependencies ---
FROM composer:2.7 AS composer-deps
WORKDIR /app
# Copy only composer files for dependency caching
COPY --link composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist --optimize-autoloader

# --- Build Stage: Node dependencies and assets ---
FROM node:20-alpine AS node-build
WORKDIR /app
COPY --link package.json package-lock.json ./
RUN npm install --no-audit --no-fund
COPY --link resources/ ./resources/
COPY --link vite.config.* ./
RUN npm run build

# --- Final Stage: PHP runtime ---
FROM php:8.2-fpm-alpine AS final

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    icu-dev libzip-dev zlib-dev libpng-dev libjpeg-turbo-dev freetype-dev \
    oniguruma-dev bash curl git sqlite sqlite-dev pdo_sqlite 

RUN docker-php-ext-install intl pdo pdo_mysql pdo_sqlite zip gd

# Install Composer (for artisan at runtime)
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Create non-root user
RUN addgroup -S appgroup && adduser -S appuser -G appgroup

WORKDIR /var/www/html

# Copy application source (excluding files via .dockerignore)
COPY --link . .

# Copy vendor from composer build
COPY --from=composer-deps /app/vendor ./vendor

# Copy built assets from node build
COPY --from=node-build /app/resources ./resources
COPY --from=node-build /app/public/build ./public/build

# Ensure storage and bootstrap/cache are writable
RUN mkdir -p storage bootstrap/cache \
    && chown -R appuser:appgroup storage bootstrap/cache \
    && chmod -R ug+rw storage bootstrap/cache

USER appuser

# Expose port 8000 for Laravel's built-in server
EXPOSE 8000

# Default command: start Laravel's built-in server
CMD ["php", "artisan", "serve", "--host=127.0.0.1", "--port=8000"]
