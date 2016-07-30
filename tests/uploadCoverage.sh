#! /bin/bash

set -x

if [ "$TYPE" == "coverage" ]
then
	vendor/bin/phpunit --coverage-clover coverage.clover
	wget https://scrutinizer-ci.com/ocular.phar
	php ocular.phar code-coverage:upload --format=php-clover coverage.clover
fi