FROM php:8.1-fpm-alpine

RUN apk --no-cache add postgresql-dev \
    && docker-php-source extract \
    && docker-php-ext-install -j$(nproc) pdo_pgsql \
    && docker-php-source delete

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY php.ini $PHP_INI_DIR/php.ini

WORKDIR /app
