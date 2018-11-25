#Install

docker-compose build

docker-compose up -d

docker exec -it -u dev sf4_php bash

cd /home/wwwroot/sf4

composer install

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force

#Autowiring : injecter dynamiquement -> php bin/console debug:autowiring

php bin/console doctrine:migrations:status --show-versions
php bin/console doctrine:migrations:migrate --version xxx




