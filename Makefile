lint:
	composer exec --verbose phpcs -- --standard=PSR12 app public routes tests --ignore=public/
test:
	php artisan test --coverage --min=80