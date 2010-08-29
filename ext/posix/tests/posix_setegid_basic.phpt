--TEST--
Basic test for posix_setegid
--CREDITS--
PHP Testfest 2010 Berlin
Andreas Mauf <hello@amauf.de>
--SKIPIF--
<?php 
if (!extension_loaded('posix')) print 'skip, posix extension not available';
if (posix_geteuid() != 0) print "skip, need to be root";
--FILE--
<?php
$mygid = posix_getegid();
var_dump(posix_setegid($mygid));
--EXPECTF--
bool(true)
