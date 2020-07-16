#FROM php:7.4-fpm
#
## Set working directory
#WORKDIR /var/ww/html
#
## Clear cache
#RUN apt-get clean && rm -rf /var/lib/apt/lists/*
#
#RUN apt-get update && apt-get install -y \
#        libfreetype6-dev \
#        libjpeg62-turbo-dev \
#        libpng-dev \
#    && docker-php-ext-configure gd --with-freetype --with-jpeg \
#    && docker-php-ext-install -j$(nproc) gd
#
## Instalar php-pgsql
#RUN apt-get install -y libpq-dev \
#    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
#    && docker-php-ext-install pdo pdo_pgsql
#
## Instalar php-soap
#RUN apt-get install -y libxml2-dev \
#    && docker-php-ext-install soap
#
## Instalar php-gd
#RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
#    && docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/ \
#    && docker-php-ext-install gd exif
#
## Instalar php-zip
#RUN apt-get install -y libzip-dev zip \
#    && docker-php-ext-install zip
#
## Install composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#
#RUN composer global require hirak/prestissimo
#
## Install dependencies
#RUN apt-get update && apt-get install -y unzip git
#
## Install XDebug for PHPUnit Code Coverage
#RUN yes | pecl install xdebug \
#    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
#    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini
#
## Add user for Laravel application
#RUN groupadd -g 1000 ubuntu
#RUN useradd -u 1000 -ms /bin/bash -g ubuntu ubuntu
#
## Change current user
#USER ubuntu
#
## Expose port 9000 and start php-fpm server
#EXPOSE 9000
#CMD ["php-fpm"]

FROM nginx
WORKDIR /var/www/html

