.DEFAULT_GOAL := help

.PHONY: start
start: ## Start environment
	docker-compose -f docker-compose.yml up