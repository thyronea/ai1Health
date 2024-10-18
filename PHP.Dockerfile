FROM php:fpm

RUN apt-get update && \
    apt-get install -y libxml2-dev

RUN docker-php-ext-install soap

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN pecl install xdebug && docker-php-ext-enable xdebug
