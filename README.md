## Ejercicio resuelto Fuego de Quasar
## DEMO
* http://83.136.219.31:9999
* change URL in ML.postman_collection.json
## Install server test
#### Prerequisites
* composer
* php >7
#### Install
* sudo apt install php7.4-common php7.4-mysql php7.4-xml php7.4-xmlrpc php7.4-curl php7.4-gd php7.4-imagick php7.4-cli php7.4-dev php7.4-imap php7.4-mbstring php7.4-opcache php7.4-soap php7.4-zip php7.4-intl -y
* composer install 
* cp .env.example .env
* php artisan key:generate
## Run server
* php artisan serve
* http://127.0.0.1:8000
## Run test
* vendor/bin/phpunit tests/
## Test with Postman
* To consider: Content-Type: application/json
* ML.postman_collection.json

## Config Env Satelites (set positions satelites)
KENOBIX=-500

KENOBIY=-200

SKYWALKERX=100

SKYWALKERY=-100

SATOX=500

SATOY=100

## Wiki
problem solved with the method: https://es.wikipedia.org/wiki/Trilateraci%C3%B3n
