FROM php:8.1-apache

# Enable Apache mod_rewrite (optional but useful)
RUN a2enmod rewrite

# Copy application into Apache web root
COPY . /var/www/html/

# Expose Apache default port
EXPOSE 80
