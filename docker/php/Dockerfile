FROM php:7-fpm

RUN apt-get update
RUN apt-get install -y sudo libmcrypt-dev
RUN apt-get install -y vim git zip unzip
RUN docker-php-ext-install mbstring pdo_mysql tokenizer
RUN apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN pecl install mongodb
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN pecl install redis-3.1.4 \
    && pecl install xdebug-2.6.1 \
    && docker-php-ext-enable redis xdebug

ENV QT_XKB_CONFIG_ROOT=/usr/share/X11/xkb

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/nuvem

CMD php-fpm
