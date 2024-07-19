## How install

Для запуска проекта необходимо PHP 8.1, Composer, Docker

В терминале вводим следующие команды:

- composer install
- vendor/bin/sail up -d
- vendor/bin/sail bash

Перейдя в bash выполнить следующие команды

- php artisan migrate
- php artisan db:seed
