#!/usr/bin/env sh
set -e

PORT_TO_USE="${PORT:-80}"
sed -i "s/__PORT__/${PORT_TO_USE}/g" /etc/nginx/sites-available/default

php artisan config:clear >/dev/null 2>&1 || true
php artisan route:clear >/dev/null 2>&1 || true
php artisan view:clear >/dev/null 2>&1 || true

php-fpm -D
exec nginx -g 'daemon off;'
