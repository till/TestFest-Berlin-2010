--TEST--
Error test for posix_setpgid
--CREDITS--
PHP Testfest 2010 Berlin
Andreas Mauf <hello@amauf.de>
--SKIPIF--
<?php 
if (!extension_loaded('posix')) print 'skip, posix extension not available';
--FILE--
<?php
$extra_arg = '123';

$pid = posix_getpid();
$pgid = posix_getpgid($pid);
var_dump(posix_setpgid($pid, $pgid, $extra_arg));
var_dump(posix_setpgid());
--EXPECTF--
Warning: posix_setpgid() expects exactly 2 parameters, 3 given in %s on line %d
bool(false)

Warning: posix_setpgid() expects exactly 2 parameters, 0 given in %s on line %d
bool(false)
