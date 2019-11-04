FROM php:7.2-fpm
COPY php.ini /usr/local/etc/php/
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql \
    && docker-php-ext-enable pdo_mysql