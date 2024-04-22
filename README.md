# ColisChimere

## Setup the database with docker

docker run -p 3306:3306 -e MARIADB_ALLOW_EMPTY_ROOT_PASSWORD=true mariadb

php bin/console doctrine:database:create

php bin/console doctrine:migrations:migrate