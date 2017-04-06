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

Все команды выполняются через Git Bash в директории `projects`, которая расположена в домашней директории пользователя.

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

Должна открыться страница с текстом `"Привет, Web!"`.

## Настройка Xdebug

Xdebug устанавливается на виртуальную машину web автоматичеси с помощью Ansible, но чтобы им пользоваться надо настроить свою IDE или текстовый редактор, умеющий работать с Xdebug.

### Настройка Sublime Text

#### Отладка из консоли

На примере Sublime Text 3 Build 3125. Для него должен быть установлен [Package Control](https://packagecontrol.io/installation).

В Sublime нажvbnt Ctrl+Shift+P, наберите `install package` и нажмите Enter. Затем наберите `xdebug client` и нажмите Enter.

Отредактируйте настройки в Sublime. Выберите в меню Tools -> Xdebug -> Settings-User и укажите в нем

```
{
  "path_mapping": {
    "/home/ubuntu/www": "D:/path/to/sripts",
  }
}
```

У меня на хостовой машине php-скрипты лежать в папке D:\path\to\sripts, поэтому надо указать в Settings-User "D:/path/to/sripts". Укажите вместо этого пути свой.

Подключитесь по SSH к виртуалной машине web

```
~/projects/web-dev$ vagrant ssh web
```

Создайте переменную окружения XDEBUG_CONFIG

```
ubuntu@web:~$ export XDEBUG_CONFIG="idekey=sublime.xdebug"
```

Эта переменная окружения удаляется, когда вы завершаете SSH соединение с web или перезагружаете ее.

Поставьте точку остановки в скрипте www/index.php

В меню Sublime выберите Tools -> Xdebug -> Start Debugging

На виртуальной машине web выполните

```
ubuntu@web:~/www$ php index.php
```

Должен начать выполняться скрип и остановиться на строке, где вы поставили точку остановки в Sublime.

Для того чтобы завешить сеанс отладки, выберите в меню Tools -> Xdebug -> Stop Debugging (Close Windows)

#### Отладка из браузера

Отредактируйте настройки Xdebug в Sublime, выберите в меню Tools -> Xdebug -> Settings-User, и отредактируйте их следующим образом

```
{
  "path_mapping": {
    "/home/ubuntu/www": "D:/path/to/sripts",
  },
  "settings": {
    "xdebug": {
      "url": "http://192.168.35.10/",
    }
  }
}
```

где D:/path/to/sripts - путь к php-скриптам на хостовой машине.

Поставьте точку остановки в php-скрипте. В меню Sublime выберите Tools -> Xdebug -> Start Debugging

Откройте в бразуре ссылку http://192.168.35.10/?XDEBUG_SESSION_START=sublime.xdebug

Выполнение скрпта остановится на строке, в которой вы поставили точку остановки, эта строка отобразиться в Sublime.

Для того чтобы завешить сеанс отладки, выберите в меню Tools -> Xdebug -> Stop Debugging (Close Windows)

## Использование PHPUnit

PHPUnit устанавливается автоматически на виртуальную машину web, при выполнении плэйбука main.yml.

Для того чтобы запустить юнит-тесты, подключитесь по SSH к виртуальной машине web.

```
~/projects/web-dev$ vagrant ssh web
```

Перейдите в директорию `www` и вызовите `phpunit` с необходимыми агрументами

```
ubuntu@web:~/www$ phpunit --bootstrap src/Email.php tests/EmailTest
```

Если хотите увидеть процент покрытия кода юнит-тестами, выполните

```
ubuntu@web:~/www$ phpunit --coverage-text --whitelist src --bootstrap src/Email.php tests/EmailTest
```

## Использование phpDocumentor

phpDocumentor устанавливается автоматически на виртуальную машину web, при выполнении плэйбука main.yml.

Для того чтобы сгенерировать документацию, подключитесь по SSH к виртуальной машине web.

```
~/projects/web-dev$ vagrant ssh web
```

Перейдите в директорию `www` и вызовите `phpdoc` с необходимыми агрументами

```
ubuntu@web:~/www$ phpdoc -d ./src -t ./docs
```

Сгенерированную документацию можно посмотреть черезе браузер, открыв на хостовой машине файл www/docs/index.html