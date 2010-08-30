#!/bin/bash
phpsrc=php-src
export TEST_PHP_EXECUTABLE=$phpsrc/sapi/cli/php

if [ ! -d $phpsrc ]; then
    echo php-src auf das PHP-Quellverzeichnis linken
    exit 1
fi

extdir=$phpsrc/ext
testdir=ext/$ext/tests

tests=""
for file in ./run_*; do
    if [ "$file" = "./run_all.sh" ]; then
        continue;
    fi
    ext=${file:6}
    ext=${ext/.sh/}

    tests="${tests} ${extdir}/${ext} ext/${ext}/tests"
done

#cleanup
if [ -f covdata-all.info ]; then
    rm covdata-all.info
fi

if [ -d htmlcoverage_all ]; then
    rm -r htmlcoverage_all
fi

#run
$TEST_PHP_EXECUTABLE -c $phpsrc/php.ini-production \
    $phpsrc/run-tests.php -c $phpsrc/php.ini-production \
    $tests

#html
lcov --directory $extdir -c -o covdata-all.info
genhtml covdata-all.info -o htmlcoverage_all