--TEST--
Error test for posix_setegid
--CREDITS--
PHP Testfest 2010 Berlin
Andreas Mauf <hello@amauf.de>
--SKIPIF--
<?php 
if (!extension_loaded('posix')) print 'skip posix extension not available';
if (posix_geteuid() != 0) print "skip, need to be root";
--FILE--
<?php
$gid = '123';
$extra_arg = '12312';

var_dump(posix_setegid($gid, $extra_arg));
var_dump(posix_setegid());

--EXPECTF--
Warning: posix_setegid() expects exactly 1 parameter, 2 given in %s on line %d
bool(false)

Warning: posix_setegid() expects exactly 1 parameter, 0 given in %s on line %d
bool(false)
