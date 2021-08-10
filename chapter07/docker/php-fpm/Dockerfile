FROM php:7.3-fpm-alpine
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apk upgrade --update \
    && apk add --no-cache \
        cyrus-sasl-dev \
        freetype \
        freetype-dev \
        g++ \
        git \
        libmcrypt \
        libmcrypt-dev \
        libmemcached-dev \
        libxml2-dev \
        make \
        tzdata \
        zlib-dev \
        autoconf \
        curl \
        nginx \
        nodejs \
        npm \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache pdo pdo_mysql \
    # Set time zone to Asia/Seoul
    && cp /usr/share/zoneinfo/Asia/Seoul /etc/localtime \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    # Modify FPM parameter
    && sed -i 's/^\(pm.max_children = \).*/\140/g' /usr/local/etc/php-fpm.d/www.conf \
    && mkdir -p /var/www/html \
    && mkdir -p /usr/share/nginx/html \
    && echo "Not Found" > /usr/share/nginx/html/index.html \
    && rm -f /etc/nginx/conf.d/default.conf \
    && sed -i -e "s|listen.allowed_clients = 127.0.0.1|;listen.allowed_clients = 127.0.0.1|" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i -e "s|;catch_workers_output = yes|catch_workers_output = yes|" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i -e "s|; process.dumpable = yes|process.dumpable = yes|" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i -e "s|;rlimit_core = 0|rlimit_core = unlimited|" /usr/local/etc/php-fpm.d/www.conf

RUN apk add --no-cache \
            xvfb \
            # Additionnal dependencies for better rendering
            ttf-freefont \
            fontconfig \
            dbus \
    && \

    # Install wkhtmltopdf from `testing` repository
    apk add qt5-qtbase-dev \
            wkhtmltopdf \
            --no-cache \
            --repository http://dl-3.alpinelinux.org/alpine/edge/testing/ \
            --allow-untrusted \
    && \

    # Wrapper for xvfb
    mv /usr/bin/wkhtmltopdf /usr/bin/wkhtmltopdf-origin && \
    echo $'#!/usr/bin/env sh\n\
Xvfb :0 -screen 0 1024x768x24 -ac +extension GLX +render -noreset & \n\
DISPLAY=:0.0 wkhtmltopdf-origin $@ \n\
killall Xvfb\
' > /usr/bin/wkhtmltopdf && \
    chmod +x /usr/bin/wkhtmltopdf \
    && rm -rf /var/cache/apk/*

COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/nginx/conf.d/ /etc/nginx/conf.d/
COPY ./docker/php-fpm/conf/opcache.ini $PHP_INI_DIR/conf.d/
COPY ./docker/php-fpm/php.ini $PHP_INI_DIR/conf.d/zphp.ini

COPY ./docker/php-fpm/run.sh /usr/local/bin/run.sh
ENTRYPOINT [ "/usr/local/bin/run.sh" ]
