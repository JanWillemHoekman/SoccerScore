FROM nginx:1.25-alpine

ENV DOMAIN_NAME localhost
COPY ../configs/default.conf.template /etc/nginx/templates/