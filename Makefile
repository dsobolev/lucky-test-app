.PHONY: start

filename := database/database.sqlite

install:
	test -e $(filename) || touch $(filename)
	composer install
	php artisan migrate:fresh
	php artisan db:seed

start:
	docker compose up --detach && \
	php artisan serve --port 8001

stop:
	docker compose down
	kill $$(ps aux | grep 'php artisan serve' | head -1 | awk '{print $$2}')

# logs:
# 	docker compose logs

# app-shell:
# 	docker compose exec app sh

# artisan:
# #     @$(eval c ?=)
# 	docker compose exec app "php artisan"

# ps:
# 	docker compose ps
