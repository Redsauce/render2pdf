#!/bin/sh
set -xe

nginx && \
certbot --nginx --non-interactive --agree-tos --email webmaster@redsauce.net --domains pdf.redsauce.net && \
killall nginx

go run /scheduler/scheduler.go 02:30 certbot renew &
sleep 1
nginx -g "daemon off;"

# echo "certbot renew" > /etc/periodic/daily/cerbot-renewal && \
# chmod +x /etc/periodic/daily/certbot-renewal && \
