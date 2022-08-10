.PHONY: $(makecmdgoals)

run-consumer-tests:
	docker-compose exec unified-user-service-php bin/phpunit
