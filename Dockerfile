FROM webdevops/php-nginx:8.2

ENV WEB_DOCUMENT_ROOT /var/www/app/public
ENV WEB_DOCUMENT_INDEX index.php
ENV COMPOSER_VERSION 2
ENV PHP_DATE_TIMEZONE America/Sao_Paulo

# Instalação do Xdebug
RUN pecl install -f xdebug-3.2.2 && \
    docker-php-ext-enable xdebug

# Configuração do Xdebug
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /var/www/app
