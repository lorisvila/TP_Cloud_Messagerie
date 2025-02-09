FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html

RUN apt-get update
RUN apt-get install -y systemd
RUN apt-get install -y systemctl

COPY ./services/php-script.service /etc/systemd/system/php-script.service
COPY ./services/php-server.service /etc/systemd/system/php-server.service

RUN systemctl daemon-reload
RUN systemctl enable php-server php-script

EXPOSE 8080