# Stage 1: Build vendor
FROM composer:2 as build
WORKDIR /app
COPY . /app
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Stage 2: Final Image
FROM php:8.4-apache

# Install dependencies (Semua dalam 1 baris untuk elak ralat syntax)
RUN apt-get update && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip && docker-php-ext-install pdo pdo_mysql

# Enable Apache rewrite
RUN a2enmod rewrite

WORKDIR /var/www

# Salin folder vendor dari stage build
COPY --from=build /app/vendor /var/www/vendor
COPY . /var/www

# Konfigurasi Apache
ENV APACHE_DOCUMENT_ROOT /var/www/public
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf
RUN echo '<Directory "/var/www/public">\nAllowOverride All\n</Directory>' >> /etc/apache2/apache2.conf

# Permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache