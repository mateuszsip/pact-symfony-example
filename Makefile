.PHONY: $(makecmdgoals)

run-consumer-tests:
	docker-compose exec unified-user-service-php bin/phpunit

run-provider-tests:
	docker-compose exec cards-php bin/phpunit

setup-provider-db:
	docker-compose exec cards-php bin/console doctrine:schema:create
