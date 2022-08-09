FROM php:8.1-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-source extract \
    && docker-php-ext-install -j$(nproc) pdo_pgsql \
    && docker-php-source delete

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY php.ini $PHP_INI_DIR/php.ini

WORKDIR /app
