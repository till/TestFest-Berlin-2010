--TEST--
Basic test for posix_getegid
--CREDITS--
PHP Testfest 2010 Berlin
Andreas Mauf <hello@amauf.de>
--SKIPIF--
<?php 
if (!extension_loaded('posix')) print 'skip posix extension not available';
--FILE--
<?php
var_dump(posix_getegid());
--EXPECTF--
int(%d)
