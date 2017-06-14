## Emotico Frontend
- this laravel / voyager project is the frontend for the emotico media service

## prerequisites
- linux
- installed docker
- installed docker-compose version 2 (>1.6)
- composer

## usage
- clone project

```sh
docker-compose-up -d
```
- change to application
```sh
composer install
```

## Install voyager and emotico basedate
```sh
php artisan voyager:install
php artisan db:seed --class=EmoticoDatabaseSeeder
```

- surf to http://localhost:8080

## Run tests
- there are some basic unit and integrationtests 
- change to laradock/application

## bind to emotico backend
- install emotico project
- configure mediaconverter section in .env file

```sh
./vendor/bin/phpunit tests
```
