FROM php:7.2-cli

RUN apt-get update \
	&& docker-php-ext-install -j$(nproc) pdo pdo_mysql
