FROM php:8.1-fpm-alpine

# Установка необходимых пакетов
RUN apk add --no-cache nginx wget postgresql-dev autoconf g++ make

# Установка PHP расширений
RUN docker-php-ext-install pdo_pgsql && \
    pecl install redis && \
    docker-php-ext-enable redis

# Установка Composer
RUN wget http://getcomposer.org/composer.phar && \
    chmod a+x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Копирование конфигурации Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Установка рабочего каталога и копирование приложения
WORKDIR /app
COPY . .

# Копирование .env.example в .env и обновление значений переменных окружения
RUN cp /app/.env.example /app/.env && \
    php artisan key:generate && \
    sed -i 's/^DB_CONNECTION=mysql/DB_CONNECTION=pgsql/' /app/.env && \
    sed -i 's/^DB_HOST=127.0.0.1/DB_HOST=postgres/' /app/.env && \
    sed -i 's/^DB_PORT=3306/DB_PORT=5432/' /app/.env && \
    sed -i 's/^DB_DATABASE=laravel/DB_DATABASE=monuments/' /app/.env && \
    sed -i 's/^DB_USERNAME=root/DB_USERNAME=postgres/' /app/.env && \
    sed -i 's/^DB_PASSWORD=/DB_PASSWORD=20050404iliA/' /app/.env && \
    cat .env && \
    composer update && \
    php artisan migrate && \
    chmod -R 777 /app/storage

# Запуск PHP-FPM и Nginx
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
