## Ejercicio resuelto Fuego de Quasar
## DEMO
* http://83.136.219.31:9999
* change URL in ML.postman_collection.json
## Install server test
####Prerequisites
* composer
* php >7
#### Install
* composer install 
* cp .env.example .env
* php artisan key:generate
## Run server
* php artisan serve
* http://127.0.0.1:8000
## Run test
* vendor/bin/phpunit tests/
## Test with Postman
ML.postman_collection.json

## Config Env Satelites (set positions satelites)
KENOBIX=-500

KENOBIY=-200

SKYWALKERX=100

SKYWALKERY=-100

SATOX=500

SATOY=100

## Wiki
problem solved with the method: https://es.wikipedia.org/wiki/Trilateraci%C3%B3n
