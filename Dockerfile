FROM php:7.4-apache-stretch
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update -y && apt-get install -y libpng-dev
RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev
RUN apt-get install -y libzip-dev
RUN apt-get install zip unzip
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

EXPOSE 8080
COPY . /var/www/
WORKDIR /var/www/
RUN composer install

COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .env.example /var/www/.env
RUN chmod 777 -R /var/www/storage/ && \
    echo "Listen 8080" >> /etc/apache2/ports.conf && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite


