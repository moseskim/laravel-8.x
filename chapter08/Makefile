all: install composer-install db test

install:
	test -f .env || cp -a .env.example .env
	docker-compose up -d
.PHONY: install

composer-install:
	docker-compose run --rm composer install
	docker-compose exec -T php php artisan key:generate
.PHONY: composer-install

db:
	docker-compose exec -T php ./docker/wait-for-it.sh db:3306
	docker-compose exec -T php php artisan migrate
	docker-compose exec -T php php artisan db:seed
.PHONY: db

test:
	docker-compose exec -T php ./vendor/bin/phpunit
.PHONY: test

test-php8:
	docker-compose run --rm php8 ./vendor/bin/phpunit
.PHONY: test-php8

phpstan:
	docker-compose run --rm phpstan analyse
.PHONY: phpstan

clean:
	docker-compose down
.PHONY: clean
