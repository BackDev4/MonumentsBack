FROM php:8.3-fpm-alpine

RUN apk add --no-cache nginx wget

RUN mkdir -p /run/nginx

COPY nginx.conf /etc/nginx/nginx.conf

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN cd /usr/local/bin/composer install --no-dev

RUN chown -R www-data: /app

CMD sh startup.sh