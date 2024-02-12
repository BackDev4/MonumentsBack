FROM php:8.3-fpm-alpine

RUN apk add --no-cache nginx wget postgresql-dev

# Установка драйвера PDO для PostgreSQL и расширения pgsql
RUN docker-php-ext-install pdo pdo_pgsql pgsql

# Установка Composer
RUN wget http://getcomposer.org/composer.phar && \
    chmod a+x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Перемещение в директорию приложения и установка зависимостей
WORKDIR /app
COPY . /app
RUN composer install --no-dev

# Назначение прав пользователю www-data
RUN chown -R www-data: /app
# Запуск Nginx и PHP-FPM

CMD sh /app/startup.sh

