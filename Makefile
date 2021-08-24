COMPOSE_FILE := ./docker/docker-compose.dev.yml
# COMPOSE_FILE := ./docker/docker-compose.prod.yml

start:
	docker-compose -f ${COMPOSE_FILE} up -d

stop:
	docker-compose -f ${COMPOSE_FILE} down

build:
	docker-compose -f ${COMPOSE_FILE} build

ps:
	docker-compose -f ${COMPOSE_FILE} ps

exec:
	docker-compose -f ${COMPOSE_FILE} exec php bash
