FROM php:8-apache

ENV ENVIRONMENT="production"
# postgresql://[user[:password]@][netloc][:port][/dbname][?param1=value1&...]
# Quizá algo parecido a lo de abajo? desde app parsear la url
# ENV DATABASE_URL="postgresql://root:toor@postgres:5432/root"
# pero esto lo recibe sin que yo lo pongo en el Dockerfile


# heroku DATABASE_URL: 	postgres://lfhylpxczlxsbu:6537391f5c41eb24a2baab9961bc782e2f23ec8afd6927b60b01f93f341023f9@ec2-52-86-223-172.compute-1.amazonaws.com:5432/dugb5ufho9l0i

# RUN docker-php-ext-install mysqli pdo_mysql pdo_pgsql && docker-php-ext-enable mysqli pdo_mysql pdo_pgsql


RUN apt-get update
# Install Postgre PDO
RUN apt-get install -y libpq-dev \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql

RUN a2enmod rewrite

COPY . /var/www/html
# quizá aquí lanzar composer?
