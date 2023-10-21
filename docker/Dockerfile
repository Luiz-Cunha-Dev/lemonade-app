FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    zip \
    unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

RUN docker-php-ext-install mysqli

WORKDIR /var/www/html

COPY ../ /var/www/html/lemonade

EXPOSE 80