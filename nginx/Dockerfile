FROM nginx:alpine
RUN rm /etc/nginx/nginx.conf /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf
#EXPOSE 80
WORKDIR /var
VOLUME /logs
VOLUME /src:/var/www
CMD ["nginx", "-g", "daemon off;"]
