FROM php:8.1-fpm-alpine

RUN apk add --no-cache nginx wget postgresql-dev autoconf g++ make supervisor

RUN docker-php-ext-install pdo_pgsql && \
    pecl install redis && \
    docker-php-ext-enable redis

RUN wget http://getcomposer.org/composer.phar && \
    chmod a+x composer.phar && \
    mv composer.phar /usr/local/bin/composer

COPY nginx.conf /etc/nginx/nginx.conf
COPY supervisord.conf /etc/supervisord.conf

WORKDIR /app
COPY . .

RUN cp /app/.env.example /app/.env && \
    php artisan key:generate && \
    echo "DB_CONNECTION=pgsql" >> /app/.env && \
    echo "DB_HOST=postgres" >> /app/.env && \
    echo "DB_PORT=5432" >> /app/.env && \
    echo "DB_DATABASE=monuments" >> /app/.env && \
    echo "DB_USERNAME=postgres" >> /app/.env && \
    echo "DB_PASSWORD=20050404iliA" >> /app/.env && \
    composer update && \
    php artisan migrate && \
    chmod -R 777 /app/storage

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
