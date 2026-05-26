FROM php:8.4-apache

RUN docker-php-ext-install pdo_mysql mysqli

RUN echo "AddDefaultCharset UTF-8" > /etc/apache2/conf-available/charset.conf && \
    a2enconf charset

COPY mi-codigo /var/www/html
