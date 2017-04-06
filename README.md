# Среда для разработки веб-проектов

Настройки для Vagrant и плэйбук Ansible, чтобы быстро поднять на компьютере среду для разработки, которая содержит Nginx и PHP.

## Минимальные системные требования

 * Процессор Intel Core i3
 * Оперативной памяти 8 ГБайт
 * Жесткий диск 40 ГБайт
 * Подключение к интернету 2 Мбит/с
 * Windows 7 SP1 64bit
 * VirtualBox 5.1.12
 * Git version 2.7.4.windows.1
 * Vagrant 1.9.3

## Использование

Все команды выполняются через Git Bash в директории projects, которая расположена в домашней директории пользователя.

### Склонировать репозиторий

```
~/projects$ git clone ssh://git@git.prp.ru:7999/web/web-dev.git
```

### Запустить виртуальные машины

Перейтив директорию проекта и запустить виртуальные машины

```
~/projects$ cd web-dev/
~/projects/web-dev$ vagrant up
```

### Настроить виртуальную машину с помощью Ansible

Подключиться к виртуальной машине ansible

```
~/projects/web-dev$ vagrant ssh ansible
```

Перейти в директорию ansible и запустить плэйбук main.yml

```
ubuntu@ansible:~$ cd ansible/
ubuntu@ansible:~/ansible$ ansible-playbook main.yml
```

### Открыть в браузере сайт

Перейти по ссылке http://192.168.35.10/