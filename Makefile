build:
	@docker-compose up -d --build
	@docker-compose exec -T app composer install -n
	@ echo "\n$(green)Dependencies are build$(no_color)\n\n"

up:
	@ docker-compose up -d
	@ echo "\n$(green)Dependencies are up$(no_color)\n\n"

down:
	@ docker-compose down

bash:
	@ docker-compose exec app bash

test:
	@ docker-compose exec -T app php ./vendor/bin/phpunit --coverage-text

test-coverage:
	@ docker-compose exec -T app php ./vendor/bin/phpunit --coverage-html coverage

composer-install:
	@ docker-compose exec app composer install

composer-update:
	@ docker-compose exec app composer update

migrate-fresh:
	@ docker-compose exec app php artisan migrate:fresh

migrate-fresh-seed:
	@ docker-compose exec app php artisan migrate:fresh --seed

