# ============================================================
# Variables
# ============================================================
SAIL       = ./vendor/bin/sail
ARTISAN    = $(SAIL) artisan
COMPOSER   = composer
NPM        = npm

GREEN  = \033[0;32m
YELLOW = \033[0;33m
RED    = \033[0;31m
RESET  = \033[0m

# ============================================================
.DEFAULT_GOAL := help

help:
	@echo ""
	@echo "$(GREEN)Commandes disponibles :$(RESET)"
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) \
		| awk 'BEGIN {FS = ":.*?## "}; {printf "  $(YELLOW)%-25s$(RESET) %s\n", $$1, $$2}'
	@echo ""

# ============================================================
# Installation
# ============================================================
install: ## Installation complète
	@echo "$(GREEN)Installation...$(RESET)"
	$(COMPOSER) install
	cp -n .env.example .env || true
	$(ARTISAN) key:generate
	$(ARTISAN) up -d
	$(ARTISAN) migrate --seed
	@echo "$(GREEN)✅ Terminé$(RESET)"

# ============================================================
# Base de données
# ============================================================
migrate: ## Lancer les migrations
	$(ARTISAN) migrate

migrate-fresh: ## Reset + migrations + seeders
	$(ARTISAN) migrate:fresh --seed

migrate-rollback: ## Rollback dernière migration
	$(ARTISAN) migrate:rollback

seed: ## Lancer les seeders
	$(ARTISAN) db:seed

# ============================================================
# Docker
# ============================================================
up: ## Démarrer les containers
	$(SAIL) up -d

down: ## Stopper les containers
	$(SAIL) down

restart: down up ## Redémarrer les containers

logs: ## Voir les logs Docker
	$(SAIL) logs -f

ps: ## Status des containers
	$(SAIL) ps

# ============================================================
# Tests
# ============================================================
test: ## Lancer les tests
	$(ARTISAN) test

test-coverage: ## Tests avec couverture minimum 90%
	$(ARTISAN) test --coverage --min=90

test-unit: ## Tests unitaires uniquement
	$(ARTISAN) test --testsuite=Unit

test-feature: ## Tests feature uniquement
	$(ARTISAN) test --testsuite=Feature

test-filter: ## Lancer un test spécifique  ex: make test-filter F=UserTest
	$(ARTISAN) test --filter=$(F)

test-docker: ## Tests avec PostgreSQL Docker
	@echo "$(GREEN)Démarrage PostgreSQL...$(RESET)"
	$(DC_TEST) up -d
	@sleep 3
	$(ARTISAN) migrate --env=testing --force
	$(ARTISAN) test --env=testing
	$(DC_TEST) down
	@echo "$(GREEN)✅ Tests terminés$(RESET)"

test-docker-coverage: ## Tests Docker avec couverture
	$(DC_TEST) up -d
	@sleep 3
	$(ARTISAN) migrate --env=testing --force
	$(ARTISAN) test --coverage --min=80 --env=testing
	$(DC_TEST) down

# ============================================================
# Qualité de code
# ============================================================
lint: ## Vérifier le style avec Pint
	./vendor/bin/pint --test

lint-fix: ## Corriger le style automatiquement
	./vendor/bin/pint

rector: ## Lance l'analyse de la refactorisation
	./vendor/bin/rector --dry-run

rector-fix: ## Lance la refactorisation
	./vendor/bin/rector process

phpstan: ## Analyse le le code
	./vendor/bin/phpstan analyse --memory-limit=512M

fix: ## Corriger automatiquement Pint + Rector
	./vendor/bin/pint
	./vendor/bin/rector process

# ============================================================
# Cache
# ============================================================
clear: ## Vider tous les caches
	$(ARTISAN) cache:clear
	$(ARTISAN) config:clear
	$(ARTISAN) route:clear
	$(ARTISAN) view:clear
	@echo "$(GREEN)✅ Caches vidés$(RESET)"

# ============================================================
# Utilitaires
# ============================================================
tinker: ## Ouvrir Tinker
	$(ARTISAN) tinker

routes: ## Lister les routes
	$(ARTISAN) route:list

queue: ## Démarrer le worker queue
	$(ARTISAN) queue:work

# ============================================================
# CI/CD
# ============================================================
ci: ## Vérifier la ci sans les tests
	./vendor/bin/pint --test
	./vendor/bin/rector process
	./vendor/bin/phpstan analyse --memory-limit=512M

# ============================================================
.PHONY: help install \
		migrate migrate-fresh migrate-rollback seed \
		up down restart logs ps \
		test test-coverage test-unit test-feature \
		test-filter test-docker test-docker-coverage \
		lint lint-fix rector rector-fix phpstan fix \
		clear  \
		tinker routes queue fresh \
		ci \
