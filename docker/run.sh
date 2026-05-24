#!/bin/sh

# Dynamically set Nginx port to $PORT (assigned by Railway) or fallback to 80
PORT=${PORT:-80}
echo "Configuring Nginx to listen on port $PORT..."

sed -i "s/listen 80 default_server;/listen ${PORT} default_server;/g" /etc/nginx/nginx.conf
sed -i "s/listen \[::\]:80 default_server;/listen \[::\]:${PORT} default_server;/g" /etc/nginx/nginx.conf

# Run supervisord
exec /usr/bin/supervisord -c /etc/supervisord.conf
