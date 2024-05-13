FROM php:8.1-fpm-alpine

RUN apk add --no-cache nginx wget mysql-client autoconf g++ make

RUN docker-php-ext-install pdo_mysql

RUN wget http://getcomposer.org/composer.phar && \
    chmod a+x composer.phar && \
    mv composer.phar /usr/local/bin/composer

COPY nginx.conf /etc/nginx/nginx.conf

WORKDIR /app
COPY . .

RUN cp /app/.env.example /app/.env && \
    php artisan key:generate && \
    sed -i 's/^DB_CONNECTION=mysql/DB_CONNECTION=mysql/' /app/.env && \
    sed -i 's/^DB_HOST=127.0.0.1/DB_HOST=localhost/' /app/.env && \
    sed -i 's/^DB_PORT=3306/DB_PORT=3306/' /app/.env && \
    sed -i 's/^DB_DATABASE=laravel/DB_DATABASE=monuments/' /app/.env && \
    sed -i 's/^DB_USERNAME=root/DB_USERNAME=root/' /app/.env && \
    sed -i 's/^DB_PASSWORD=/DB_PASSWORD=/' /app/.env && \
    cat .env && \
    composer update && \
    php artisan migrate && \
    php artisan db:seed && \
    chmod -R 777 /app/storage

CMD php artisan serve --host=0.0.0.0 --port=8080
