## EQS Test Task to create a simple trading app
- this laravel boilerplate just contains docker, dockercompose, nginx, mysql 5.7, php71 and the voyager app 
## videotutorial: https://youtu.be/ZY1ywgMKVoE
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

## Install eqs sampledatabase
- time was too short for good migrations and seedings. So you have to restore the sampledatabase for eqs 
- in application there is a dumpfile eqs-livedump.sql. This file you can restore on the mysql container

```sh
docker exec -it laradock_mysql_1 /bin/bash
mysql -u root -p default <path to dump>.sql
```

- surf to http://localhost

## Run tests
- there are some basic unit and integrationtests 
- change to laradock/application

```sh
./vendor/bin/phpunit tests
```
# emotico-frontend
# emotico-frontend
