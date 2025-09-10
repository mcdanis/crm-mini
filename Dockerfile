FROM php:8.1-apache

# Install ekstensi PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copy semua file project ke dalam container
COPY ./public /var/www/html/

# Enable mod_rewrite kalau butuh Laravel/Framework lain
RUN a2enmod rewrite

# instal dep for composer
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
