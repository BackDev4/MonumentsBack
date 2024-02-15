FROM php:8.3-fpm-alpine

# Install dependencies
RUN apk add --no-cache nginx wget postgresql-dev

# Install PHP extensions for PostgreSQL
RUN docker-php-ext-install pdo_pgsql pgsql

# Install Composer
RUN wget http://getcomposer.org/composer.phar && \
    chmod a+x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Install Cloud SQL Proxy
RUN wget https://dl.google.com/cloudsql/cloud_sql_proxy.linux.amd64 -O /usr/local/bin/cloud_sql_proxy && \
    chmod +x /usr/local/bin/cloud_sql_proxy

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Set working directory and copy application files
WORKDIR /app
COPY . /app

# Install Composer dependencies
RUN composer install --no-dev

# Set permissions for user www-data
RUN chown -R www-data: /app

# Start Cloud SQL Proxy and PHP-FPM
CMD sh /app/startup.sh
