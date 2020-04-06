# COOK-ME

## Requirements
- Docker (https://docs.docker.com/install/)
- Docker Compose (https://docs.docker.com/compose/install/)

## Install process
- `cp .env.dist .env` (ask for env variables values)
- `make build` (only the first time)
- `make run`
- `make generate-ssh-keys` (only the first time)
- `make-prepare`

## Folder structure
```
src
├───Api/
│   ├───Action/ <- Custom endpoints
│   ├───Listener/ <- API Platform listeners
├───DataFixtures/ <- Functional tests fake data
├───Entity/ <- Doctrine entities
├───Exception/ <- Domain exceptions
├───Migrations/ <- First migration (new migrations will be added here)
├───Repository/ <- Base repository and your repositories extending from it
├───Security/
│   ├───Authorization/ <- Place for your Voters
│   ├───Core/ <- UserProvider location
│   ├───Validator/ <- Your custom validators (see services.yml to check how they work
├───Service/ <- Your app services go here
├───Templating/ <- Reference to templates used by the MailerService
├───templates/ <- Twig templates for emails
├───tests/ <- Functional and unit tests
```

## Usage
- `make build` to build the docker environment
- `make run` to run the docker environment
- `make prepare` to install dependencies and run migrations
- `make cache-clear` clear all the caches
- `make generate-ssh-keys` to generate JWT certificates
- `http://localhost:500/api/v1/docs` to check the Open API v3 documentation
- `make restart` to stop and start containers
- `make ssh-be` to access the PHP container bash
- `make be-logs` to tail dev logs
- `make code-style` to run PHP-CS-FIXER on src and tests
- `make tests` to run the test suite

## Stack:
- `NGINX` container
- `PHP7.4 FPM` container
- `MySQL 5.7` container + `volume`