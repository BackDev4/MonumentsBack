#!/bin/sh

cp /app/.env.example /app/.env

php artisan key:generate

echo "DB_CONNECTION=pgsql" >> /app/.env
echo "DB_HOST=postgres" >> /app/.env
echo "DB_PORT=5432" >> /app/.env
echo "DB_DATABASE=monuments" >> /app/.env
echo "DB_USERNAME=postgres" >> /app/.env
echo "DB_PASSWORD=20050404iliA" >> /app/.env

composer update
php artisan migrate
php artisan storage:link
php artisan db:seed

chmod -R 777 /app/storage

php-fpm -D

nginx
