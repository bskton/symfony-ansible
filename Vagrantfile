# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.define "web" do |c|
    c.vm.box = "ubuntu/xenial64"
    c.vm.provision :shell, path: "provision/web.sh"
    c.vm.network "private_network", ip: "192.168.35.10"
    c.vm.synced_folder "www/", "/home/ubuntu/www",
        owner: "ubuntu",
        group: "www-data",
        mount_options: ["dmode=770,fmode=760"]
    c.vm.provider "virtualbox" do |vb|
        vb.name = "web"
        vb.memory = "512"
    end
  end

  config.vm.define "ansible" do |c|
    c.vm.box = "ubuntu/xenial64"
    c.vm.provision :shell, path: "provision/ansible.sh"
    c.vm.network "private_network", ip: "192.168.35.20"
    config.vm.synced_folder "ansible/", "/home/ubuntu/ansible"
    c.vm.provider "virtualbox" do |vb|
        vb.name = "ansible"
        vb.memory = "512"
    end
  end
end
