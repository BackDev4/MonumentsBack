FROM php:8.3-fpm-alpine

# Установка зависимостей
RUN apk add --no-cache nginx wget

# Копирование конфигурации Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Установка Composer
RUN wget http://getcomposer.org/composer.phar && \
    chmod a+x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Перемещение в директорию приложения и установка зависимостей
WORKDIR /app
COPY . /app
RUN composer install --no-dev

RUN php artisan key:generate

RUN php artisan optimize:clear

RUN php artisan storage:link

RUN php artisan migrate

# Назначение прав пользователю www-data
RUN chown -R www-data: /app
# Запуск Nginx и PHP-FPM
CMD nginx && php-fpm
