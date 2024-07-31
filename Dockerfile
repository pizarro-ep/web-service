FROM php:8.2-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libmariadb-dev

# Instalar extensiones de PHP
RUN docker-php-ext-install mysqli pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar el contenido del proyecto
COPY . .

# Ejecutar Composer para instalar dependencias del proyecto
RUN composer install

# Exponer el puerto para el servidor PHP
EXPOSE 9000
