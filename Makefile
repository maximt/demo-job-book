up:
	docker compose up -d
migrate:
	docker compose exec php /bin/bash -c "php yii migrate --interactive=0"
	docker compose exec php /bin/bash -c "php yii seed --interactive=0"

shell:
	docker compose exec php /bin/bash

stop:
	docker compose down
