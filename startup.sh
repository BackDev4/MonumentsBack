#!/bin/sh

cp /app/.env.example /app/.env

php artisan key:generate

echo "DB_CONNECTION=pgsql" >> /app/.env
echo "DB_HOST=localhost" >> /app/.env
echo "DB_PORT=5432" >> /app/.env
echo "DB_DATABASE=monuments" >> /app/.env
echo "DB_USERNAME=postgres" >> /app/.env
echo "DB_PASSWORD=20050404iliA" >> /app/.env

cat /app/.env

apk add --no-cache postgresql
/etc/init.d/postgresql setup
/etc/init.d/postgresql start

su postgres -c 'createdb monuments'
su postgres -c "psql -c \"CREATE USER postgres WITH PASSWORD '20050404iliA';\""
su postgres -c "psql -c \"GRANT ALL PRIVILEGES ON DATABASE monuments TO laravel;\""

composer update

php artisan migrate

php artisan storage:link

php artisan db:seed

php artisan adminlte:install

chmod -R 777 /app/storage

php-fpm -D

nginx
