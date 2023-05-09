# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Install any needed packages
RUN apt-get update && apt-get install -y \
    libzip-dev 
RUN pecl install redis
RUN docker-php-ext-enable redis

RUN docker-php-ext-install pdo_mysql 
RUN docker-php-ext-install zip

# Copy the Apache virtual host configuration file
COPY docker/apache2.conf /etc/apache2/sites-available/000-default.conf

# Enable mod_rewrite
RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html/storage

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]