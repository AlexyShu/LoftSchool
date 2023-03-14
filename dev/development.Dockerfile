FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    libmcrypt-dev \
    libicu-dev \
    libpq-dev \
    libldap2-dev \
    unzip \
    bash \
 && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-configure intl && \
    docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pdo_mysql \
    pgsql \
    gettext \
    zip \
    mbstring \
    bcmath \
    intl \
    ldap \
    exif \
 && mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY php.ini "$PHP_INI_DIR/conf.d/php.ini"

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get purge

ARG UNAME=testuser
ARG UID=1000
ARG GID=1000
RUN groupadd -g $GID -o $UNAME && useradd -m -u $UID -g $GID -o -s /bin/bash $UNAME
USER $UNAME

RUN echo "alias ll='ls -la'" >> ~/.bashrc && \
    echo "alias pu='clear && vendor/bin/phpunit'" >> ~/.bashrc && \
    echo "alias pf='pu --filter'" >> ~/.bashrc && \
    echo "alias pa='php artisan'" >> ~/.bashrc && \
    echo "alias pint='/var/www/html/vendor/bin/pint'" >> ~/.bashrc && \
    echo "alias pam='pa ide-helper:models -M'" >> ~/.bashrc && \
    echo "alias ms='pa migrate:fresh && pa db:seed'" >> ~/.bashrc && \
    echo "alias t='pa test'" >> ~/.bashrc && \
    echo "alias tf='t --filter'" >> ~/.bashrc
