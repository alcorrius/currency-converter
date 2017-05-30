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
        chmod +x /home/vagrant/currency-converter/_deployment/install.sh
        sh /home/vagrant/currency-converter/_deployment/install.sh

    SHELL

end
