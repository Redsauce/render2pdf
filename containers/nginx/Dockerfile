FROM nginx:alpine
MAINTAINER Kenan Rhoton
RUN apk add --no-cache certbot certbot-nginx git go
RUN git clone https://gitlab.redsauce.net/cmd/scheduler /scheduler
COPY conf/nginx.conf /etc/nginx/nginx.conf
COPY conf/nginx.vh.default.conf /etc/nginx/conf.d/default.conf
COPY letsencrypt-setup.sh /bin/le-setup
CMD /bin/le-setup
