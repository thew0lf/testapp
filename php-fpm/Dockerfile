FROM php:8.2-fpm-alpine
RUN apk add busybox-extras curl-dev openssl-dev
RUN apk --update \
        --no-cache \
        add git make g++ autoconf rabbitmq-c-dev libtool tzdata \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb
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
