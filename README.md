#Install

docker-compose build

docker-compose up -d

docker exec -it -u dev sf4_php bash

cd /home/wwwroot/sf4

composer install

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console d:f:l

#Autowiring : injecter dynamiquement -> php bin/console debug:autowiring
php bin/console doctrine:migrations:status --show-versions
php bin/console doctrine:migrations:migrate --version xxx

#After changing / creating Entity (make:entity)
php bin/console make:migration
php bin/console doctrine:migrations:migrate

#Emails
docker pull djfarrelly/maildev
docker run -p 1080:80 -p 1025:25 djfarrelly/maildev