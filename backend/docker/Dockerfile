FROM dunglas/frankenphp:1.11-builder-php8.5-alpine

RUN \
    apk --update --no-cache add  \
    autoconf \
    bash \
    curl-dev \
    g++ \
    curl \
    libpq-dev \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    make \
    nano \
    wget \
    yaml-dev \
    nodejs \
    npm

RUN install-php-extensions \
    pdo_pgsql \
    pgsql \
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

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo ";zend_extension=xdebug" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "memory_limit=8192M" > /usr/local/etc/php/conf.d/docker-php-memory-limit.ini

COPY ./caddy/Caddyfile /etc/frankenphp/Caddyfile

RUN mkdir -p /backend

WORKDIR /backend

COPY . /backend
