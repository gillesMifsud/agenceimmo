#Install
docker-compose build

docker-compose up -d

docker exec -it -u dev sf4_php bash

cd /home/wwwroot/sf4

composer install
