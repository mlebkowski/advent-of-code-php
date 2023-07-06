cs:
	tools/php-cs-fixer/vendor/bin/php-cs-fixer fix -v --allow-risky=yes

generate:
	NO_INTERACTION=1 AOC_SESSION_KEY=$(shell cat .env/AOC_SESSION_KEY) php generate.php

aoc-latest:
	php aoc.php

aoc-latest-2:
	php aoc.php 2
