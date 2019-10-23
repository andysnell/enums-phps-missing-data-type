FROM php:7.3-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update \
    && apt-get install -y \
        build-essential \
        zlib1g-dev \
        libzip-dev \
        zip \
        unzip \
        git \
        curl \
        libpng-dev \
        libxml2-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install -j$(nproc) pdo_mysql zip exif bcmath pcntl gd
RUN pecl install xdebug; docker-php-ext-enable xdebug; \
    echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini; \
    echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini;

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
