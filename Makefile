install:
	cp .env.local.example .env
	echo "UID=$$(id -u)" >> .env
	echo "GID=$$(id -g)" >> .env
	@make pull
	@make up
	docker compose exec php-fpm composer install
	docker compose exec php-fpm php artisan key:generate
	docker compose exec php-fpm chmod -R 777 storage bootstrap/cache
	@make up
	@make build-compose-ide
	@make fresh
pull:
	docker compose pull
build:
	docker compose build
up:
	docker compose up --detach
stop:
	docker compose stop
down:
	docker compose down --remove-orphans
down-v:
	docker compose down --remove-orphans --volumes
restart:
	@make down
	@make up
destroy:
	docker compose down --rmi all --volumes --remove-orphans
remake:
	@make destroy
	@make install
ps:
	docker compose ps
nginx:
	docker compose exec nginx sh
php-fpm:
	docker compose exec php-fpm sh
phpstan:
	docker compose exec php-fpm ./vendor/bin/phpstan analyse --memory-limit=2G
tinker:
	docker compose exec php-fpm php artisan tinker
dump:
	docker compose exec php-fpm php artisan dump-server
test:
	docker compose exec php-fpm php artisan test
migrate:
	docker compose exec php-fpm php artisan migrate
fresh:
	docker compose exec php-fpm php artisan migrate:fresh --seed
seed:
	docker compose exec php-fpm php artisan db:seed
dacapo:
	docker compose exec php-fpm php artisan dacapo
rollback-test:
	docker compose exec php-fpm php artisan migrate:fresh
	docker compose exec php-fpm php artisan migrate:refresh
optimize:
	docker compose exec php-fpm php artisan optimize
optimize-clear:
	docker compose exec php-fpm php artisan optimize:clear
composer-update:
	docker compose exec php-fpm composer update
composer-install:
	docker compose exec php-fpm composer install
cache:
	docker compose exec php-fpm composer dump-autoload --optimize
	@make optimize
	docker compose exec php-fpm php artisan event:cache
	docker compose exec php-fpm php artisan view:cache
cache-clear:
	docker compose exec php-fpm composer clear-cache
	@make optimize-clear
	docker compose exec php-fpm php artisan event:clear
	docker compose exec php-fpm php artisan view:clear

db:
	docker compose exec db bash
redis:
	docker compose exec redis redis-cli
pint:
	docker compose exec php-fpm ./vendor/bin/pint --verbose
pint-test:
	docker compose exec php-fpm ./vendor/bin/pint --verbose --test
build-compose-ide:
	docker compose config > docker-compose-ide.yml
swagger:
	docker compose exec php-fpm php artisan l5-swagger:generate
elastic-migrate:
	docker compose exec php-fpm php artisan elastic:migrate
comp-req:
	docker compose exec php-fpm composer require $(filter-out $@,$(MAKECMDGOALS))
comp-req-dev:
	docker compose exec php-fpm composer require $(filter-out $@,$(MAKECMDGOALS)) --dev
vikasearch-migrate:
	docker compose exec vikasearch bash -c 'cd .. && alembic upgrade head'
vikasearch-sync-db:
	docker compose exec php-fpm php artisan chat-intents:sync-with-classifier-db

production-build:
	@if [ ! -f .env ]; then echo "Env file $(COMPOSE_ENV_FILE) not found"; exit 1; fi
	docker compose up -d php-fpm
	docker compose exec php-fpm composer install --no-dev --optimize-autoloader
	docker compose exec php-fpm php artisan route:cache
	docker compose exec php-fpm php artisan view:cache
	docker compose exec php-fpm php artisan event:cache
	npm ci --omit=dev && npm run build
	cd Modules/VikaLauncher && npm ci --omit=dev && npm run build
	docker compose stop php-fpm

production-install:
	@if [ ! -f .env ]; then cp .env.production.example .env && echo "Created .env from .env.production.example"; fi;
	echo "UID=$$(id -u)" >> .env
	echo "GID=$$(id -g)" >> .env
	docker compose up -d php-fpm;
	docker compose exec php-fpm composer install --no-dev --optimize-autoloader
	docker compose exec php-fpm php artisan key:generate --no-interaction
	chmod -R 777 storage bootstrap/cache
	docker compose stop php-fpm
