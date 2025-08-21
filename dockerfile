FROM php:8.2-apache

# Install ekstensi mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# (opsional) aktifkan mod_rewrite kalau kamu pakai htaccess
RUN a2enmod rewrite
