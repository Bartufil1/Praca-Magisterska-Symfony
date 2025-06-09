FROM php:8.2-fpm

# Instalacja narzędzi
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Instalacja Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Skopiuj aplikację
WORKDIR /var/www/html
COPY . .

# Instalacja zależności
RUN composer install

EXPOSE 8000

# Uprawnienia
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
