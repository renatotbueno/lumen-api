FROM php:7.3-fpm

WORKDIR /var/www/html/api

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install pdo_mysql mbstring
RUN pecl install redis && docker-php-ext-enable redis

ADD custom_php.ini /usr/local/etc/php/conf.d/

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

EXPOSE 9000
CMD ["php-fpm"]
