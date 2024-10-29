# Use an official PHP runtime as a parent image. Note that I am using php 8.1 with apache
# You can get the PHP runtime version your application uses from Docker Hub
FROM php:8.1-apache

# Installs system dependencies, including PostgreSQL dev libraries
# This line is added to show you if you are using a database
# libpg-dev is the postgre library for docker. We installed it before the necessary PHP postgre modules
# if you are using a different database, just do a little research and get the required libraries to install
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pgsql pdo pdo_pgsql

# Enable Apache mod_rewrite and configure DirectoryIndex
# It ensures that Apache recognizes index.php as the default file to serve when a directory is accessed.
RUN a2enmod rewrite

# Sets the working directory in the container to /var/www/html
WORKDIR /var/www/html

# Copies the current directory contents into the container at /var/www/html
COPY . /var/www/html

# Expose port 80 for the web server
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]