#!/bin/sh

php artisan key:generate

echo "DB_CONNECTION=pgsql" >> /app/.env
echo "DB_HOST=localhost" >> /app/.env
echo "DB_PORT=5432" >> /app/.env
echo "DB_DATABASE=monuments" >> /app/.env
echo "DB_USERNAME=postgres" >> /app/.env
echo "DB_PASSWORD=20050404iliA" >> /app/.env

composer update
php artisan migrate
php artisan storage:link
php artisan db:seed
php artisan adminlte:install

chmod -R 777 /app/storage

php-fpm -D

nginx
