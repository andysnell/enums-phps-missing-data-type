FROM php:7.4-cli

ENV HHVM_DISABLE_NUMA true
ENV COMPOSER_ALLOW_SUPERUSER=1

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    zlib1g-dev \
    libzip-dev \
    zip \
    unzip \
    gnupg2 \
    git \
    curl \
    libxml2-dev \
    software-properties-common \
    apt-transport-https \
    python3

RUN apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xB4112585D386EB94 \
    && add-apt-repository https://dl.hhvm.com/debian \
    && apt-get update \
    && apt-get install -y hhvm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install -j$(nproc) zip exif bcmath pcntl

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app