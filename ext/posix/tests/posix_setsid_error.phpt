--TEST--
Error test for posix_setsid
--CREDITS--
PHP Testfest 2010 Berlin
Andreas Mauf <hello@amauf.de>
--SKIPIF--
<?php 
if (!extension_loaded('posix')) print 'skip, posix extension not available';
--FILE--
<?php
$extra_arg = 10;
var_dump(posix_setsid($extra_arg));
--EXPECTF--
Warning: posix_setsid() expects exactly 0 parameters, 1 given in %s on line %d
NULL
