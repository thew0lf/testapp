FROM nginx:alpine
RUN rm /etc/nginx/nginx.conf /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf
#EXPOSE 80
VOLUME
  ["/src:/var/www",
  "/logs:/var/log"]

CMD ["nginx", "-g", "daemon off;"]
