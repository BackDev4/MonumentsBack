#!/bin/sh

# Замена порта в конфигурации Nginx
sed -i "s,LISTEN_PORT,$PORT,g" /etc/nginx/nginx.conf

# Генерация файла .env
cp /app/.env.example /app/.env

./cloud_sql_proxy -dir=/cloudsql &

# Генерация ключа приложения Laravel
php artisan key:generate

# Настройка подключения к базе данных
sed -i "s/DB_CONNECTION=mysql/DB_CONNECTION=pgsql/" /app/.env
sed -i "s/DB_HOST=127.0.0.1/DB_HOST=/cloudsql/steel-sonar-413417:us-central1:data-base-monument/" /app/.env
sed -i "s/DB_PORT=3306/DB_PORT=5432/" /app/.env
sed -i "s/DB_DATABASE=your_database/DB_DATABASE=monuments/" /app/.env
sed -i "s/DB_USERNAME=your_username/DB_USERNAME=postgres/" /app/.env
sed -i "s/DB_PASSWORD=your_password/DB_PASSWORD=20050404iliA/" /app/.env

php artisan migrate
php artisan adminlte:install

# Установка правильных разрешений для каталога storage
chmod -R 777 /app/storage

# Запуск PHP-FPM
php-fpm -D

# Запуск Nginx
nginx
