FROM php:8.0-rc-cli-alpine

COPY opcache.ini /usr/local/etc/php/conf.d/
COPY router.php /app/router.php

RUN apk add --update \
--repository http://dl-cdn.alpinelinux.org/alpine/edge/main \
--repository http://dl-cdn.alpinelinux.org/alpine/edge/community \
zip libzip-dev gmp-dev libffi-dev libressl-dev \
&& docker-php-ext-install -j$(nproc) sockets zip gmp pcntl bcmath ffi \
&& docker-php-source delete

ENV PHP_CLI_SERVER_WORKERS=8

ENTRYPOINT ["php", "-S", "0.0.0.0:8000", "/app/router.php"]
CMD ["php", "-S", "0.0.0.0:8000", "/app/router.php"]