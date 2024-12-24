FROM php:8.3-cli

WORKDIR /var/www/html

# git - for composer packages installation
RUN apt-get update && apt-get install -y git

# xdebug
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug

# composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV PATH="$PATH:/usr/local/bin"

COPY --chown=www-data:www-data . /var/www/html

USER www-data

EXPOSE 8000

CMD composer install && php artisan key:generate && php artisan serve --host=0.0.0.0 && php artisan queue:listen --tries=1
