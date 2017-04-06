#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive

apt-get update
apt-get install -y python2.7

sudo ln -s /usr/bin/python2.7 /usr/bin/python

sed -i 's/ubuntu-xenial/web/g' /etc/hostname
sed -i 's/ubuntu-xenial/web/g' /etc/hosts

echo 'web' > /proc/sys/kernel/hostname