--TEST--
Error test for posix_setpgid by substituting argument 1 with array values.
--CREDITS--
PHP Testfest 2010 Berlin
Andreas Mauf <hello@amauf.de>
--SKIPIF--
<?php 
if (!extension_loaded('posix')) print 'skip, posix extension not available';
--FILE--
<?php
$pid = posix_getpid();
$pgid = posix_getpgid($pid);

$index_array = array(1, 2, 3);
$assoc_array = array(1 => 'one', 2 => 'two');

$variation_array = array(
	'empty array' => array(),
	'int indexed array' => $index_array,
	'associative array' => $assoc_array,
	'nested arrays' => array('foo', $index_array, $assoc_array),
);

foreach ( $variation_array as $var ) {
	var_dump(posix_setpgid($var, $pgid));
}
foreach ( $variation_array as $var ) {
	var_dump(posix_setpgid($pid, $var));
}

--EXPECTF--
Warning: posix_setpgid() expects parameter 1 to be long, array given in %s on line %d
bool(false)

Warning: posix_setpgid() expects parameter 1 to be long, array given in %s on line %d
bool(false)

Warning: posix_setpgid() expects parameter 1 to be long, array given in %s on line %d
bool(false)

Warning: posix_setpgid() expects parameter 1 to be long, array given in %s on line %d
bool(false)

Warning: posix_setpgid() expects parameter 2 to be long, array given in %s on line %d
bool(false)

Warning: posix_setpgid() expects parameter 2 to be long, array given in %s on line %d
bool(false)

Warning: posix_setpgid() expects parameter 2 to be long, array given in %s on line %d
bool(false)

Warning: posix_setpgid() expects parameter 2 to be long, array given in %s on line %d
bool(false)
