#!/bin/bash

DOCKER_API=cook-me-api
UID=$(shell id -u)

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

run: ## Start the containers
	U_ID=${UID} docker-compose up -d

stop: ## Stop the containers
	U_ID=${UID} docker-compose stop

down: ## Down the containers
	U_ID=${UID} docker-compose down

restart: ## Restart the containers
	$(MAKE) stop && $(MAKE) run

build: ## Rebuilds all the containers
	U_ID=${UID} docker-compose build

prepare: ## Runs backend commands
	$(MAKE) composer-install
	$(MAKE) migrations

# Backend commands
composer-install: ## Installs composer dependencies
	U_ID=${UID} docker exec --user ${UID} -it ${DOCKER_API} composer install --no-scripts --no-interaction --optimize-autoloader

migrations: ## Runs the migrations
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} bin/console doctrine:migrations:migrate -n

migrations-diff: ## Runs the migrations
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} bin/console doctrine:migrations:diff

fixtures: ## Load the fixtures
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} bin/console doctrine:fixtures:load

api-logs: ## Tails the Symfony dev log
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} tail -f var/log/dev.log
# End backend commands

ssh-api: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} bash

cache-clear: ## ssh's into the be container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} php bin/console cache:pool:clear cache.global_clearer

code-style: ## Runs php-cs to fix code styling following Symfony rules
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} php-cs-fixer fix src --rules=@Symfony
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} php-cs-fixer fix tests --rules=@Symfony

generate-ssh-keys: ## Generate ssh keys in the container
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} mkdir -p config/jwt
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} openssl genrsa -passout pass:password -out config/jwt/private.pem -aes256 4096
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} openssl rsa -pubout -passin pass:password -in config/jwt/private.pem -out config/jwt/public.pem

tests: ## Runs Unit and Functional tests
	U_ID=${UID} docker exec -it --user ${UID} ${DOCKER_API} bin/phpunit

.PHONY: tests
