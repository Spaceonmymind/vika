FROM nginx:1.29-otel AS production

COPY ./docker/config/nginx/templates /etc/nginx/templates
COPY ./docker/config/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./public /var/www/public
