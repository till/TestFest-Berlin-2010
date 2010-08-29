--TEST--
parameter validation test for posix_access()
--DESCRIPTION--
cases: no params, wrong param1, wrong param2, null directory, wrong directory,
--CREDITS--
PHP Testfest 2010 Berlin
Andreas Mauf <hello@amauf.de>
--SKIPIF--
<?php
if (!extension_loaded('posix')) {
    die('SKIP The posix extension is not loaded.');
}
if (posix_geteuid() == 0) {
    die('SKIP Cannot run test as root.');
}
--FILE--
<?php
var_dump( posix_access() );
var_dump( posix_access(array()) );
var_dump( posix_access('foo',array()) );
var_dump( posix_access(null) );
var_dump(posix_access('./foobar'));
--EXPECTF--
Warning: posix_access() expects at least 1 parameter, 0 given in %s on line %d
bool(false)

Warning: posix_access() expects parameter 1 to be string, array given in %s on line %d
bool(false)

Warning: posix_access() expects parameter 2 to be long, array given in %s on line %d
bool(false)
bool(false)
bool(false)
