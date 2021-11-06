FROM php:8-apache

ENV ENVIRONMENT="production"

RUN apt-get update
# Install Postgre PDO
RUN apt-get install -y libpq-dev \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql

RUN a2enmod rewrite

COPY . /var/www/html
