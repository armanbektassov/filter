up: docker-up

stop: docker-stop

composer: docker-composer

test: docker-test

bash: docker-bash

docker-up:
	docker-compose up -d

docker-stop:
	docker-compose stop

docker-composer:
	docker-compose exec filter-php-cli bash -ci "composer install"

docker-test:
	docker-compose exec filter-php-cli bash -ci "composer test"

docker-bash:
	docker-compose exec filter-php-cli bash
