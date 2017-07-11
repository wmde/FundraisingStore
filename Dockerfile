FROM php:7.1-cli

RUN apt-get update \
	&& docker-php-ext-install -j$(nproc) pdo pdo_mysql
