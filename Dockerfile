FROM php:8.4-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . /var/www 

#Set Apache DocumentRoot to Laravel public
ENV APACHE_DOCUMENT_ROOT /var/www/public

# Update Apache config to allow .htaccess overrides
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory "/var/www/public">\nAllowOverride All\n</Directory>' >> /etc/apache2/apache2.conf

# Fix permissions
RUN chown -R www-data:www-data /var/www