.DEFAULT_GOAL := help

.PHONY: start
start: ## Start environment
	docker-compose -f docker-compose.yml up

.PHONY: run_test
rt: ## Run tests
	docker exec -it php_mytheresa php bin/phpunit

.PHONY: init_environment
iv: ## Run tests
	docker exec -it php_mytheresa composer install && docker exec -it php_mytheresa php bin/console doctrine:database:create && docker exec -it php_mytheresa php bin/console doctrine:schema:create && docker exec -it php_mytheresa php bin/console doctrine:schema:update --force && docker exec -it php_mytheresa php bin/console mytheresa:database:prepare
