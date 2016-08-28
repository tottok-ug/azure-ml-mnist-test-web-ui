FROM alpine
    
RUN apk update && \
    apk add apache2 php5-apache2 php5-gd php5-json php5-curl && \
    echo "ServerName $HOSTNAME" >/etc/apache2/conf.d/fqdn.conf && \
    rm -rf /var/cache/apk/* && \
    mkdir /run/apache2 

COPY ./public/ /var/www/localhost/htdocs/
EXPOSE 80  
CMD ["httpd","-D", "FOREGROUND"]
