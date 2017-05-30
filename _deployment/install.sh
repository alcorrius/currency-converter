#!/bin/bash
###
###Installation and configuration for Ubuntu
###

#change user who store application files
USER=vagrant

#set mariadb password
MYSQL_ROOT_PASSWORD=root

###
###installation section
###

apt-get update

###install php and nginx
apt-get install -y php5 php5-cli php5-fpm
apt-get install -y nginx

###get and install composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer

cd /home/${USER}/currency-converter
sudo -u ${USER} -H sh -c "composer install"

###configure nginx
ln -s /home/${USER}/currency-converter/public /usr/share/nginx/html/currency-converter

cp /home/${USER}/currency-converter/_deployment/nginx /etc/nginx/sites-available/currency-converter
ln -s /etc/nginx/sites-available/currency-converter /etc/nginx/sites-enabled/

rm /etc/nginx/sites-enabled/default
service nginx restart

###configure include_path
ln -s /home/${USER}/currency-converter/vendor/zendframework/zendframework1/library/Zend /usr/share/php/Zend

###mariadb install
export DEBIAN_FRONTEND=noninteractive
apt-get install -y expect
apt-get install -y mariadb-server
SECURE_MYSQL=$(expect -c "
set timeout 1
spawn mysql_secure_installation
expect \"Enter current password for root (enter for none):\"
send \"\r\"
expect \"Set root password?\"
send \"y\r\"
expect \"New password:\"
send \"$MYSQL_ROOT_PASSWORD\r\"
expect \"Re-enter new password?\"
send \"$MYSQL_ROOT_PASSWORD\r\"
expect \"Remove anonymous users?\"
send \"y\r\"
expect \"Disallow root login remotely?\"
send \"y\r\"
expect \"Remove test database and access to it?\"
send \"n\r\"
expect \"Reload privilege tables now?\"
send \"y\r\"
expect eof
")

echo "$SECURE_MYSQL"

###create CONVERTER database
mysql -uroot -p${MYSQL_ROOT_PASSWORD} -e 'create database converter'


###add cron job to update rates
sudo -u ${USER} -H sh -c '(echo "00 * * * * /usr/bin/php /home/${USER}/currency-converter/cronjob/updateRates.php") | crontab -'