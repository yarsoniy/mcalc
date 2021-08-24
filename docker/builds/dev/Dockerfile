###### PHP
FROM php:8.0.9-fpm AS fpm
ENV REFRESHED_AT 2019-12-05
RUN apt-get update
VOLUME /code
WORKDIR /code

###### Nginx
FROM nginx:1.15 AS nginx
COPY ./docker/builds/dev/nginx.conf /etc/nginx/conf.d/default.conf
VOLUME /code
WORKDIR /code
