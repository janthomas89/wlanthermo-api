# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # Define VM box
  config.vm.box = "chef/debian-7.4-i386"
  config.vm.box_url = "https://vagrantcloud.com/chef/boxes/debian-7.4-i386/versions/1.0.0/providers/virtualbox.box"


  # Configure Network
  config.vm.network :forwarded_port, guest: 80, host: 8081


  # Configure synced folders
  config.vm.synced_folder "./src" , "/var/www/api", owner: "vagrant", group: "www-data", mount_options: ["dmode=770,fmode=660"]


  # Configure Provisioning
  config.vm.provision :shell, path: "bin/bootstrap.sh"

end
