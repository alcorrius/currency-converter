# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|

    config.vm.box = "ubuntu/trusty64"

    config.vm.network "public_network", bridge: "wlp3s0"


    config.vm.synced_folder "./", "/home/vagrant/currency-converter", id: "vagrant-root",
                                                     :owner => "vagrant",
                                                     :group => "www-data",
                                                     :mount_options => ["dmode=775","fmode=664"]
    config.vm.synced_folder ".", "/vagrant", disabled:true


    config.vm.provider "virtualbox" do |vb|
    #   # Display the VirtualBox GUI when booting the machine
    #   vb.gui = true
    #
    #   # Customize the amount of memory on the VM:
     vb.memory = "1024"
    end

    config.vm.provision "shell", inline: <<-SHELL
        sudo su
        #change user who store application files
        USER=vagrant

        #set mariadb password
        MYSQL_ROOT_PASSWORD=root

        ###
        ###installation section
        ###

        apt-get update

        ###install php and nginx
        apt-get install -y php5 php5-cli php5-fpm php5-mysql
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
        apt-get install -y mysql-server

        ###create CONVERTER database
        mysql -uroot -e 'create database converter'

        ###db migrate
        sudo -u ${USER} -H sh -c "php vendor/bin/phinx migrate"

        ###db update rates
        sudo -u ${USER} -H sh -c "php cronjob/updateRates.php"

        ###add cron job to update rates
        sudo -u ${USER} -H sh -c '(echo "00 * * * * /usr/bin/php /home/${USER}/currency-converter/cronjob/updateRates.php") | crontab -'

    SHELL

end
