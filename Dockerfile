FROM php:8.1-fpm-alpine

# Install dependencies
RUN apk add --no-cache nginx wget postgresql-dev

# Install PHP extensions for PostgreSQL
RUN docker-php-ext-install pdo_pgsql pgsql

# Install Composer
RUN wget http://getcomposer.org/composer.phar && \
    chmod a+x composer.phar && \
    mv composer.phar /usr/local/bin/composer

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Set working directory and copy application files
WORKDIR /app
COPY . /app

# Install Composer dependencies
RUN composer install --no-dev

# Set permissions for user www-data
RUN chown -R www-data: /app

# Run startup script
CMD sh /app/startup.sh
