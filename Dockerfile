FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
        libpq-dev \
        && docker-php-ext-install pdo pdo_pgsql pgsql

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN chown -R www-data:www-data /var/www/html

RUN apt-get update && apt-get install -y nodejs npm

RUN node -v && npm -v
