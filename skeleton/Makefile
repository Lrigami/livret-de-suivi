.PHONY: tests
test:
	php bin/console doctrine:database:drop --env=test --force --if-exists
	php bin/console doctrine:database:create --env=test --if-not-exists
	php bin/console doctrine:schema:update --env=test --force
	php bin/console doctrine:fixtures:load --env=test --no-interaction
	php bin/phpunit --coverage-html var/coverage/html