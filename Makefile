help:                                                                           ## shows this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\.]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.PHONY: phpcs-check
phpcs-check:                                                                   ## run phpcs
	vendor/bin/phpcs

.PHONY: phpcs-fix
phpcs-fix:                                                                     ## run phpcs fixer
	vendor/bin/phpcbf

.PHONY: phpstan
phpstan:                                                                        ## run phpstan static code analyser
	vendor/bin/phpstan analyse

.PHONY: psalm
psalm:                                                                          ## run psalm static code analyser
	vendor/bin/psalm

infection:                                                                      ## run infection
	vendor/bin/infection

.PHONY: phpunit
phpunit:                                                                        ## run phpunit tests
	vendor/bin/phpunit --testdox --colors=always -v $(OPTIONS)

.PHONY: static
static: phpcs-check phpstan psalm                                                ## run static analyser

.PHONY: test
test: phpunit                                                                   ## run tests

.PHONY: dev
dev: static test infection                                                      ## run dev tools
