FROM nginx:alpine
RUN rm /etc/nginx/nginx.conf /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf
EXPOSE 80
STOPSIGNAL SIGTERM
CMD ["nginx", "-g", "daemon off;"]
WORKDIR /var/www
# Essentials
RUN echo "UTC" > /etc/timezone
RUN apk add --no-cache zip unzip curl sqlite nginx supervisor

# Installing bash
RUN apk add bash
RUN sed -i 's/bin\/ash/bin\/bash/g' /etc/passwd


# Installing PHP
RUN apk add --no-cache php \
    php-common \
    php-fpm \
    php-pdo \
    php-opcache \
    php-zip \
    php-phar \
    php-iconv \
    php-cli \
    php-curl \
    php-openssl \
    php-mbstring \
    php-tokenizer \
    php-fileinfo \
    php-json \
    php-xml \
    php-xmlwriter \
    php-simplexml \
    php-dom \
    php-pdo_mysql \
    php-pdo_sqlite \
    php-tokenizer \
    php-pecl-redis \
    php-pecl-mongodb\
    php-pecl-intl\
    php-pecl-zip\
    php-pecl-\

RUN ln -s /usr/bin/php /usr/bin/php
#
#RUN apk --update \
#        --no-cache \
#        add git make g++ autoconf rabbitmq-c-dev libtool tzdata icu-dev libzip-dev linux-headers libsodium-dev \
#    && docker-php-ext-enable sodium \
#    && pecl install mongodb \
#    && docker-php-ext-enable mongodb \
#    && pecl install xdebug \
#    && docker-php-ext-enable xdebug \
#    && pecl install zip \
#    && docker-php-ext-enable zip \
#    && pecl clear-cache \
#    && docker-php-ext-configure intl \
#        && docker-php-ext-install intl \
#        && docker-php-ext-enable intl.so \
#
RUN php composer.phar update
RUN ./vendor/bin/phpunit ./tests
