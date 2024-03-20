#!/bin/sh

# Копирование файла .env
cp /app/.env.example /app/.env

# Установка PostgreSQL
apk add --no-cache postgresql
/etc/init.d/postgresql setup
/etc/init.d/postgresql start

# Создание базы данных и пользователя PostgreSQL
su postgres -c 'createdb monuments'
su postgres -c "psql -c \"CREATE USER postgres WITH PASSWORD '20050404iliA';\""
su postgres -c "psql -c \"GRANT ALL PRIVILEGES ON DATABASE monuments TO postgres;\""

# Генерация ключа приложения Laravel
php artisan key:generate

# Настройка подключения к базе данных PostgreSQL
echo "DB_CONNECTION=pgsql" >> /app/.env
echo "DB_HOST=localhost" >> /app/.env
echo "DB_PORT=5432" >> /app/.env
echo "DB_DATABASE=monuments" >> /app/.env
echo "DB_USERNAME=postgres" >> /app/.env
echo "DB_PASSWORD=20050404iliA" >> /app/.env

cat /app/.env

# Проверка статуса PostgreSQL и выполнение миграций и других операций Laravel
pg_ctl status | grep "no server running" && exit 1
composer update
php artisan migrate
php artisan storage:link
php artisan db:seed
php artisan adminlte:install

# Установка правильных разрешений для каталога storage
chmod -R 777 /app/storage

# Запуск PHP-FPM и Nginx
php-fpm -D
nginx
