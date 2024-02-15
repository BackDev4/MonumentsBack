FROM php:8.3-fpm-alpine

# Установка зависимостей
RUN apk add --no-cache nginx wget postgresql-dev

# Установка расширений PHP для PostgreSQL
RUN docker-php-ext-install pdo_pgsql pgsql

# Копирование конфигурации Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Установка Composer
RUN wget http://getcomposer.org/composer.phar && \
    chmod a+x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Установка Cloud SQL Proxy
RUN wget https://dl.google.com/cloudsql/cloud_sql_proxy.linux.amd64 -O /usr/local/bin/cloud_sql_proxy && \
    chmod +x /usr/local/bin/cloud_sql_proxy

# Перемещение в директорию приложения и установка зависимостей Composer
WORKDIR /app
COPY . /app
RUN composer install --no-dev

# Назначение прав пользователю www-data
RUN chown -R www-data: /app

# Запуск Cloud SQL Proxy и PHP-FPM
CMD sh /app/startup.sh
