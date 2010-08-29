--TEST--
POSIX: test seteuid()
--SKIPIF--
<?php 
if (!extension_loaded("posix")) { die('skip - need POSIX extension for test'); }
if ('WIN' === substr(PHP_OS, 0, 3)) { die('skip - can\'t test with windows'); }
if (0 != posix_getuid()) { die('skip - you need root privileges to test'); }
if (!posix_getpwnam('nobody')) { die('skip - need nobody account for test'); }
--FILE--
<?php
extract(posix_getpwnam('nobody'));
var_dump(posix_getuid() != $uid);
var_dump(posix_geteuid() != $uid);
var_dump(posix_seteuid($uid));
var_dump(posix_getuid() != $uid);
var_dump(posix_geteuid() != $uid);
--EXPECTF--
bool(true)
bool(true)
bool(true)
bool(true)
bool(false)
--CREDITS--
Roy Kaldung, roy@kaldung.com
PHP Testfest Berlin 8/29/2010
