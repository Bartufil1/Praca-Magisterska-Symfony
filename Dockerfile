FROM php:8.2-fpm

# Instalowanie wymaganych zależności
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libzip-dev git unzip

# Instalowanie Symfony i Composer
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony*/bin/symfony /usr/local/bin/symfony
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Skopiowanie aplikacji do kontenera
COPY . /var/www/html

WORKDIR /var/www/html

# Instalowanie zależności PHP
RUN composer install

# Konfiguracja portu
EXPOSE 8080

# Uruchomienie serwera
CMD ["symfony", "serve", "--no-tls", "--allow-all-ip"]
