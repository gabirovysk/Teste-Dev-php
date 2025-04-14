FROM php:8.2

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY ./api-clientes .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000