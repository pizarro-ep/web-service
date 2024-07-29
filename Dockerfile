# Usa una imagen base de PHP 8.2
FROM php:8.2-fpm

# Instala extensiones necesarias
RUN apt-get update && \
    apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libonig-dev libmariadb-dev-compat libmariadb-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd mysqli pdo pdo_mysql

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configura el directorio de trabajo
WORKDIR /var/www/html

# Copia el código al contenedor
COPY . /var/www/html
