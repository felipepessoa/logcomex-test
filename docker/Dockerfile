FROM dunglas/frankenphp:1.11-builder-php8.5-alpine


RUN \
    apk --update --no-cache add  \
    autoconf \
    bash \
    curl \
    curl-dev \
    g++ \
    git \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    make \
    nano \
    supervisor \
    wget \
    yaml-dev \
    nano

RUN install-php-extensions \
    pdo_mysql \
    gd \
    intl \
    zip \
    opcache \
    ctype \
    curl \
    dom \
    fileinfo \
    filter \
    hash \
    mbstring \
    openssl \
    pcre \
    pdo \
    session \
    tokenizer \
    xml

RUN \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && pecl update-channels \
    && pecl install redis yaml \
    && docker-php-ext-enable redis yaml 
