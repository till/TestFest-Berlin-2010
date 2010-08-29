--TEST--
Basic test for posix_setpgid
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
var_dump(posix_setpgid($pid, $pgid));
--EXPECTF--
bool(true)
