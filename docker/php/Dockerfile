# docker/php/Dockerfile
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl

# Instalar extensões do PHP
RUN docker-php-ext-install pdo_mysql exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar diretório de trabalho
WORKDIR /var/www

# Copiar arquivos do projeto
COPY . /var/www

# Instalar dependências do PHP
RUN composer install

# Alterar permissões
RUN chown -R www-data:www-data /var/www

# Expor a porta 9000
EXPOSE 9000

# Iniciar PHP-FPM
CMD ["php-fpm"]
