get-data:
	php artisan app:get-data
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app public routes tests --ignore=public/
test:
	php artisan test --coverage --min=80
railway: migrate get-data start
PORT ?= 6985
start:
	PHP_CLI_SERVER_WORKERS=5 php -S 0.0.0.0:$(PORT)  -t public
migrate:
	php artisan migrate:fresh --force
	php artisan migrate --force