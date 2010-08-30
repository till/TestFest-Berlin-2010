#!/bin/sh
phpsrc=php-src
export TEST_PHP_EXECUTABLE=$phpsrc/sapi/cli/php

if [ ! -d $phpsrc ]; then
    echo php-src auf das PHP-Quellverzeichnis linken
    exit 1
fi

ext=`echo $0 | sed 's/.*run_//' | sed 's/\\.sh//'`
if [ "x$ext" = "x" ]; then
    echo "Copy that script to run_extname.sh"
    exit 2
fi

extdir=$phpsrc/ext/$ext
testdir=ext/$ext/tests

if [ ! -d $extdir ]; then
    echo "There is no extension named \"$extdir\""
    exit 3
fi

#cleanup
[ -f covdata-$ext.info ] && rm covdata-$ext.info
[ -f $extdir/$ext.gcda ] && rm $extdir/$ext.gcda
[ -d htmlcoverage_$ext ] && rm -r htmlcoverage_$ext

if [ x$1 != x ]; then
    if [ -f $1 ] || [ -d $1 ]; then
        test=$1
    else
        test=$testdir/$1
    fi
elif [ -d $testdir ]; then
    test="$testdir $extdir"
else
    test=$extdir
fi

#run
$TEST_PHP_EXECUTABLE -c $phpsrc/php.ini-production \
    $phpsrc/run-tests.php -c $phpsrc/php.ini-production \
    $test

#html
lcov --directory $extdir -c -o covdata-$ext.info
genhtml covdata-$ext.info -o htmlcoverage_$ext