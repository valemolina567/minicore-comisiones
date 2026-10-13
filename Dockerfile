FROM composer:2 AS build

WORKDIR /app

COPY . .

RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libicu-dev \
    && docker-php-ext-install mysqli pdo_mysql intl \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri \
    -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

COPY --from=build /app /var/www/html

RUN chown -R www-data:www-data \
    /var/www/html/writable

EXPOSE 80