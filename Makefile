.PHONY: $(makecmdgoals)

run-consumer-tests:
	docker-compose exec unified-user-service-php bin/phpunit

run-provider-tests:
	docker-compose exec cards-php bin/phpunit

setup-provider-db:
	docker-compose exec cards-php bin/console doctrine:schema:create

setup-example-accounts:
	curl -X POST -i -d'{"consumer": "unified-user-service", "state": "accounts exist"}' -H "Content-Type: application/json" localhost:9901/setup-state

start-stubs:
	docker-compose start pact-cards-stub pact-cards-stub-empty
