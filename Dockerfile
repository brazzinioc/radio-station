FROM php:7.4.24-fpm

WORKDIR /var/www

# Install dependencies
RUN apt-get update -y && apt-get update --fix-missing && apt-get install pkg-config
RUN export PKG_CONFIG_PATH=/usr/lib/pkgconfig
RUN apt-get install nodejs npm build-essential libpng-dev libjpeg62-turbo-dev libfreetype6-dev locales zip jpegoptim optipng pngquant gifsicle vim unzip curl git libpq-dev openssl libssl-dev libcurl4-openssl-dev libonig-dev libxml2 libxml2-dev libzip-dev -y

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql bcmath ctype tokenizer curl mbstring xml zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install -j$(nproc) gd
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY ./src/ /var/www

RUN composer install
RUN npm install

# Copy existing application directory permissions
#COPY --chown=www:www . /var/www
RUN chown -R www:www /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
