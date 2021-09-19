.DEFAULT_GOAL := help

.PHONY: start
start: ## Start environment
	docker-compose -f docker-compose.yml up

.PHONY: run_test
rt: ## Run tests
	docker exec -it php_con php bin/phpunit
