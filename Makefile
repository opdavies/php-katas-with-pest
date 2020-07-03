CLEAN_PATHS=vendor
PEST_PATH=vendor/bin/pest

all: test

clean:
	@for dir in $(CLEAN_PATHS); do \
		rm -fr $$dir; \
	done

pest: vendor
	@$(PEST_PATH)

test: pest

vendor: composer.json composer.lock
	@composer install

.PHONY: all clean pest test
