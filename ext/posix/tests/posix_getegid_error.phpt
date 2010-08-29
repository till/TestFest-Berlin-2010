--TEST--
Error test for posix_getegid
--CREDITS--
PHP Testfest 2010 Berlin
Andreas Mauf <hello@amauf.de>
--SKIPIF--
<?php 
if (!extension_loaded('posix')) print 'skip posix extension not available';
--FILE--
<?php
$extra_args = array( 12312, 2 => '1234', 'string' => 'string' );

var_dump( posix_getegid( $extra_args ));
foreach ( $extra_args as $arg ) {
	var_dump(posix_getegid( $arg ));
}
--EXPECTF--
Warning: posix_getegid() expects exactly 0 parameters, 1 given in %s on line %d
NULL

Warning: posix_getegid() expects exactly 0 parameters, 1 given in %s on line %d
NULL

Warning: posix_getegid() expects exactly 0 parameters, 1 given in %s on line %d
NULL

Warning: posix_getegid() expects exactly 0 parameters, 1 given in %s on line %d
NULL
