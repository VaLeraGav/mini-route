FROM php:8.2-fpm

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
COPY docker/php/php.ini /usr/local/etc/php/
