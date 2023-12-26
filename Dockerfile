# Use an official PHP runtime as a parent image
FROM php:8.0.26-apache

# Set the working directory to /app
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

# Install any needed packages specified in composer.json
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql
md
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Run composer install to install dependencies
RUN composer install

# Make port 80 available to the world outside this container
EXPOSE 80

# Define environment variables
ENV APACHE_DOCUMENT_ROOT /app/public
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data

# Configure Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Start Apache
CMD ["apache2-foreground"]
