FROM php:7.3
RUN apt-get update
RUN apt-get -y install libzip-dev
RUN docker-php-ext-install pdo pdo_mysql zip
COPY --from=composer /usr/bin/composer /usr/bin/composer
