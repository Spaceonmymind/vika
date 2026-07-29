FROM registry.ugraphic.ru/vi/images/laravel-php/base:latest AS production

COPY ./docker/config/php/php.ini-production /usr/local/etc/php/php.ini
COPY ./docker/config/php/conf.d/config.ini-production /usr/local/etc/php/conf.d/common/config.ini
COPY ./docker/config/php/php-fpm.d/zzz-custom.conf /usr/local/etc/php-fpm.d/zzz-custom.conf

COPY ./docker/config/horizon/supervisord.conf /etc/supervisord.conf
COPY ./docker/config/horizon/supervisor.d/ /etc/supervisor.d

COPY ./docker/bin/ /usr/local/bin/

COPY ./ /var/www
