# Use the official PHP image
FROM php:8.1-apache

# Copy your PHP script into the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html/

# Expose the port for Apache
EXPOSE 80
