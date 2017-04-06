#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive

apt-get install -y software-properties-common
apt-add-repository -y ppa:ansible/ansible
apt-get update
sudo apt-get install -y --allow-unauthenticated ansible

cp /vagrant/.vagrant/machines/web/virtualbox/private_key /home/ubuntu/.ssh/web
chown ubuntu:ubuntu /home/ubuntu/.ssh/web
chmod 0400 /home/ubuntu/.ssh/web

sed -i 's/ubuntu-xenial/ansible/g' /etc/hostname
sed -i 's/ubuntu-xenial/ansible/g' /etc/hosts

echo 'ansible' > /proc/sys/kernel/hostname