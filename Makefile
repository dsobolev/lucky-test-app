.PHONY: start

filename := database/database.sqlite

install:
	test -e $(filename) || touch $(filename)
	composer install
	php artisan migrate:fresh
	php artisan db:seed

start:
	docker compose up --detach && \
	php artisan serve --port 8001 > /dev/null 2>&1 &
	php artisan queue:work

stop:
	docker compose down
	kill $$(ps aux | grep 'php artisan serve' | head -1 | awk '{print $$2}')
