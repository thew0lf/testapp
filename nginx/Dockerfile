FROM nginx:alpine

RUN rm -fr /etc/nginx
RUN mkdir -p /etc/nginx

COPY nginx.conf /etc/nginx/

RUN nginx