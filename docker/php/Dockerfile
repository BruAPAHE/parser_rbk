FROM php:7.3-fpm-alpine

RUN apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        curl-dev \
        imagemagick-dev \
        libtool \
        libxml2-dev \
        icu-dev \
    && apk add --no-cache \
        curl \
        git \
        imagemagick \
        libintl \
        icu \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install \
        curl \
        iconv \
        mbstring \
        pcntl \
        tokenizer \
        xml \
        intl \
    && curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer \
    && apk del -f .build-deps

WORKDIR /app
