
.PHONY: up up-d up-b up-r down composer composer-install composer-update run cache-clear setup

setup:
	@test -f .env || cp .env.dist .env

-include .env

# Змінні для Docker
PROJECT_NAME ?= $(shell grep -m 1 'PROJECT_NAME' .env | cut -d '=' -f2-)

DOCKER_COMPOSE = docker-compose --env-file .env
PHP_BASH = docker exec -it php_$(PROJECT_NAME) /bin/bash
DOCKER_EXEC = $(PHP_BASH) -c

# Docker Compose Commands
up: setup
	$(DOCKER_COMPOSE) up

up-d: setup
	$(DOCKER_COMPOSE) up -d

up-b: setup
	$(DOCKER_COMPOSE) up --build

up-r: setup
	$(DOCKER_COMPOSE) up --force-recreate

down: setup
	$(DOCKER_COMPOSE) down --remove-orphans

exec: setup
	$(DOCKER_EXEC) "echo -e '\033[32m'; /bin/bash"

# Composer Commands
composer: setup
	$(DOCKER_EXEC) "composer $(CMD)"

composer-install: CMD = install
composer-install: composer

composer-update: CMD = update
composer-update: composer

composer-i: composer-install
composer-u: composer-update

test: CMD = test
test: composer

run: EXEC = "$(filter-out $@,$(MAKECMDGOALS))"
run:
	@if [ -z "$(EXEC)" ]; then \
		echo "Error: No arguments provided for 'run' command."; \
		exit 1; \
	fi
	$(DOCKER_EXEC) "php bin/console $(EXEC)"

# Це скидає будь-які аргументи передані до 'run', роблячи їх не-цілями
%:
	@:
