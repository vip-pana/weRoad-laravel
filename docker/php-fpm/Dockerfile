FROM php:8.2-fpm

RUN apt-get update

RUN apt-get install -y zlib1g-dev libpq-dev git libicu-dev libxml2-dev libzip-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip xml

# Install ext-gc
RUN apt-get install -y libpng-dev libonig-dev \ 
    && docker-php-ext-install gd \
    && docker-php-ext-enable gd

RUN docker-php-ext-install mbstring pdo

RUN docker-php-ext-install soap
RUN docker-php-ext-install sockets

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Rome /etc/localtime
RUN "date"

#@ldmdev Set php timezone
RUN printf '[PHP]\ndate.timezone = "Europe/Rome"\n' > /usr/local/etc/php/conf.d/tzone.ini

#Composer
RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

#NPM
RUN apt-get install -y npm

#Fix npm permissions
RUN mkdir /var/www/.npm && chown -R 1000:1001 /var/www/.npm

#@ldmdev Remap uid of www-data to avoid permission issues
RUN usermod -u 1000 www-data
RUN groupmod -g 1001 www-data
