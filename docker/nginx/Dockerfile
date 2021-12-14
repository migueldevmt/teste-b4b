FROM nginx:1.20.1-alpine

ARG NGINX_CONF_FILE
COPY $NGINX_CONF_FILE /etc/nginx/conf.d/default.conf

COPY public /var/www/html/public/
