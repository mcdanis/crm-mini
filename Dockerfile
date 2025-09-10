FROM php:8.1-apache

# Install ekstensi PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copy semua file project ke dalam container
COPY ./public /var/www/html/

# Enable mod_rewrite kalau butuh Laravel/Framework lain
RUN a2enmod rewrite
