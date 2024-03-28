FROM php:8.1-fpm-alpine

RUN apk add --no-cache nginx wget postgresql-dev autoconf g++ make

RUN docker-php-ext-install pdo_pgsql && \
    pecl install redis && \
    docker-php-ext-enable redis

RUN wget http://getcomposer.org/composer.phar && \
    chmod a+x composer.phar && \
    mv composer.phar /usr/local/bin/composer

COPY nginx.conf /etc/nginx/nginx.conf

WORKDIR /app
COPY . .

COPY startup.sh /startup.sh
RUN chmod +x /startup.sh

RUN composer install --no-dev

CMD ["sh", "/startup.sh"]
