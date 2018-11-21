#Install

docker-compose build

docker-compose up -d

docker exec -it -u dev sf4_php bash

cd /home/wwwroot/sf4

composer install

php bin/console doctrine:migrations:status --show-versions
php bin/console doctrine:migrations:migrate --version

php bin/console doctrine:schema:update --force


