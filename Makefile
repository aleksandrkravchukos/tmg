## Build the docker container, install the dependencies
build:
	docker-compose build

## Install the composer dependencies
vendors-install:
	docker exec -it tmg_app composer install

## Install the composer dependencies
npm-install:
	docker exec -it tmg_app npm install

## Migrates
migrate:
	docker exec -it tmg_app php artisan migrate

## Update the composer dependencies
vendors-update:
	docker exec -it tmg_app composer update

## Docker containers up
up:
	docker-compose up -d

## Docker containers up
check:
	docker ps

## Update composer autoload
dump-autoload:
	docker exec -it tmg_app composer dump-autoload

## Run unit tests
static-analysis:
	docker exec -it tmg_app /var/www/html/vendor/bin/phpstan analyze /var/www/html/app

## Run cs-fixer
cs-fix:
	docker exec -it tmg_app /var/www/html/vendor/bin/php-cs-fixer fix /var/www/html/app
