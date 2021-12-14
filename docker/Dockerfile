FROM php:8.0.8-fpm-alpine3.13

ARG WWWGROUP=1000
ARG APP_ENV

WORKDIR /var/www/html

RUN apk add --no-cache \
    autoconf \
    bash \
    build-base \
    geoip \
    geoip-dev\
    python2 \
    su-exec \
    shadow \
    sqlite; apk add --no-cache sqlite-dev; \
    \
    mkdir -p /usr/share/GeoIP && cd /usr/share/GeoIP/ && \
    wget http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz && \
    wget http://geolite.maxmind.com/download/geoip/database/GeoLiteCountry/GeoIP.dat.gz && \
    gzip -d *; \
    \
    pecl install geoip-1.1.1;\
    \
    docker-php-ext-enable geoip; \
    \
    docker-php-ext-install \
    pcntl \
    pdo \
    pdo_sqlite;

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN adduser -g $WWWGROUP -u 1337 -D sail

COPY ./docker/start-container /usr/local/bin/start-container
COPY ./docker/php.ini /etc/php/8.0/cli/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

COPY resources /var/www/html/resources/

COPY composer.json composer.lock /var/www/html/
RUN if [ "$APP_ENV" = "production" ] ; then \
    composer install --no-scripts --no-interaction --ignore-platform-reqs --optimize-autoloader; \
    else \
    composer install --no-scripts --no-interaction --ignore-platform-reqs; \
    fi

COPY . /var/www/html/
RUN chmod 777 -R /var/www/html/storage /var/www/html/bootstrap/cache
