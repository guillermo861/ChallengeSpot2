#!/bin/sh

cd /var/www

composer install

# php artisan migrate:fresh --seed
php artisan install

# /usr/bin/supervisord -c /etc/supervisord.conf
