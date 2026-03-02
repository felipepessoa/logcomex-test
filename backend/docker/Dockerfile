FROM frankenphp-8.5-base


RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo ";zend_extension=xdebug" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "memory_limit=8192M" > /usr/local/etc/php/conf.d/docker-php-memory-limit.ini \
    \
    && pecl install pcov \
    && docker-php-ext-enable pcov

COPY ./caddy/Caddyfile /etc/frankenphp/Caddyfile

RUN mkdir -p /backend

WORKDIR /backend

COPY . /backend
