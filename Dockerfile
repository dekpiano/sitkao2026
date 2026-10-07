FROM php:8.3-apache

# Install dependencies and required PHP extensions for CodeIgniter 4
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    ssl-cert \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl mysqli pdo_mysql zip

# Enable Apache Mod Rewrite and SSL
RUN a2enmod rewrite ssl socache_shmcb \
    && a2ensite default-ssl

# Change document root to public folder for CodeIgniter 4
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html
