.PHONY: start

filename := database/database.sqlite

install:
	test -e $(filename) || touch $(filename)
	composer install

start:
	docker compose up --detach && \
	php artisan serve --port 8001

stop:
	docker compose down

# logs:
# 	docker compose logs

# app-shell:
# 	docker compose exec app sh

# artisan:
# #     @$(eval c ?=)
# 	docker compose exec app "php artisan"

# ps:
# 	docker compose ps
