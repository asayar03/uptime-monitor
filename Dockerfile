FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libicu-dev \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql intl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY --link \
    --from=ghcr.io/symfony-cli/symfony-cli:latest \
    /usr/local/bin/symfony /usr/local/bin/symfony