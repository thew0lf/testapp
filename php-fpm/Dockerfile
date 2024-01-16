FROM php:8.2-fpm-alpine

RUN apk add busybox-extras curl-dev openssl-dev
RUN apk update php
RUN apk --update \
        --no-cache \
        add git make g++ autoconf rabbitmq-c-dev libtool tzdata icu-dev libzip-dev linux-headers libsodium-dev \
    && docker-php-ext-enable sodium \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && pecl install zip \
    && docker-php-ext-enable zip \
    && pecl clear-cache \
    && docker-php-ext-configure intl \
        && docker-php-ext-install intl \
        && docker-php-ext-enable intl.so
ENV TZ=UTC
RUN apk del --purge make g++ autoconf libtool \
    && rm -rf /var/cache/apk/*
RUN cd /usr/local/etc/php/conf.d/ && \
  echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-ram-limit.ini
RUN mkdir -p /var/www
RUN mkdir -p /var/log/nginx
RUN mkdir -p /etc/nginx/
#COPY nginx.conf /etc/nginx/nginx.conf

RUN ls -la
COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
WORKDIR /var/www
#COPY /nginx/nginx.conf /etc/nginx/nginx.conf
#RUN echo "composer"
#RUN cd /var/www/src && ls -la && php composer.phar update

EXPOSE 9000

CMD php-fpm

#RUN echo "tests"
#RUN cd src && pwd && vendor/bin/phpunit tests
