#!/bin/bash
#######################################################################

# Start server
sudo apt-get update
sudo apt-get upgrade -y

# Change owner
sudo chown ubuntu:ubuntu /var/www/html/cataliz-web/
sudo chmod 775 -R /var/www/html/cataliz-web/public/

# Rebuilt Storage
cd /var/www/html/cataliz-web/
sudo rm -rf public/storage
sudo php artisan storage:link

# Change permissions
sudo chmod -Rv 777 storage/
sudo chmod -Rv 777 bootstrap/cache
