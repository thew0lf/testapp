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
RUN apk add --no-cache php82 \
    php82-common \
    php82-fpm \
    php82-pdo \
    php82-opcache \
    php82-zip \
    php82-phar \
    php82-iconv \
    php82-cli \
    php82-curl \
    php82-openssl \
    php82-mbstring \
    php82-tokenizer \
    php82-fileinfo \
    php82-json \
    php82-xml \
    php82-xmlwriter \
    php82-simplexml \
    php82-dom \
    php82-pdo_mysql \
    php82-pdo_sqlite \
    php82-tokenizer \
    php82-pecl-redis \
    php82-pecl-mongodb\
    php82-pecl-intl\
    php82-pecl-zip\
    php82-pecl-\

RUN ln -s /usr/bin/php82 /usr/bin/php
RUN php composer.phar update
RUN ./vendor/bin/phpunit ./tests
