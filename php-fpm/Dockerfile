FROM php:8.2-fpm-alpine
RUN apk add busybox-extras curl-dev openssl-dev
RUN apk --update \
        --no-cache \
        add git make g++ autoconf rabbitmq-c-dev libtool tzdata icu-dev \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && pecl clear-cache \
    && docker-php-ext-configure intl \
        && docker-php-ext-install intl \
        && docker-php-ext-enable intl.so
RUN php -m
RUN apk add  php82-sodium php82-pecl-xdebug php82-zip && \
    docker-php-ext-enable sodium xdebug zip

#    && docker-php-ext-install intl sodium xdebug zip \
#    && docker-php-ext-configure intl sodium xdebug zip \
#    && docker-php-ext-enable intl  sodium xdebug zip
#    && pecl install sodium \
#    && docker-php-ext-enable sodium \
#    && pecl install xdebug \
#    && docker-php-ext-enable xdebug \
#    && pecl install zip \
#    && docker-php-ext-enable zip

ENV TZ=UTC
RUN apk del --purge make g++ autoconf libtool \
    && rm -rf /var/cache/apk/*
RUN cd /usr/local/etc/php/conf.d/ && \
  echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-ram-limit.ini
RUN mkdir -p /var/www
RUN mkdir -p /etc/nginx/
RUN ls -la
COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
WORKDIR /var/www

EXPOSE 9000

CMD php-fpm
