# ./docker/php/Dockerfile
FROM php:7.2-fpm-alpine

RUN apk update \
    && apk add  --no-cache \
    git \
    curl \
    icu-dev \
    libxml2-dev \
    g++ \
    make \
    autoconf \
    && docker-php-source extract \
    && docker-php-source delete \
    && docker-php-ext-install pdo_mysql soap intl zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /tmp/*


WORKDIR /var/www/symfony

COPY . /var/www/symfony

RUN composer install