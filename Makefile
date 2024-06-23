up:
	docker compose up -d

migrate:
	docker compose exec php /bin/bash -c "php yii migrate --interactive=0"
	docker compose exec php /bin/bash -c "php yii seed --interactive=0"

test:
	docker compose exec php /bin/bash -c "tests/bin/yii migrate --interactive=0"
	docker compose exec php /bin/bash -c "./vendor/bin/codecept run unit"

shell:
	docker compose exec php /bin/bash

down:
	docker compose down
