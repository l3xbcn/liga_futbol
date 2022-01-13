#! /bin/sh
php artisan config:clear
php artisan view:clear
php artisan cache:clear
php artisan config:cache
