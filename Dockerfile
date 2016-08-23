FROM php:5-fpm-alpine
COPY ./public/ /var/www/html/
EXPOSE 80

CMD ['/usr/sbin/httpd', 'start' ]
