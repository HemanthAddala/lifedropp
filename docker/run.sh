#!/bin/sh

# Dynamically set Nginx port to $PORT (assigned by Railway) or fallback to 80
PORT=${PORT:-80}
echo "Configuring Nginx to listen on port $PORT..."

sed -i "s/listen 80 default_server;/listen ${PORT} default_server;/g" /etc/nginx/nginx.conf
sed -i "s/listen \[::\]:80 default_server;/listen \[::\]:${PORT} default_server;/g" /etc/nginx/nginx.conf

# Run database migrations on startup
echo "Pre-run: Waiting for database to initialize..."
sleep 4
echo "Running Laravel database migrations..."
php artisan migrate --force
echo "Seeding default admin and mock clinical data..."
php artisan db:seed --force

# Run supervisord
exec /usr/bin/supervisord -c /etc/supervisord.conf
