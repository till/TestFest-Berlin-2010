--TEST--
basic test for chroot
--SKIPIF--
<?php
if (!extension_loaded("posix")) { die('skip - need POSIX extension for testing'); }
if ('WIN' === substr(PHP_OS, 0, 3)) { die('skip - can\'t test with windows'); }
if (0 != posix_getuid()) { die('skip - you need root privileges to test'); }
if ('/' === posix_cwd()) { die('skip - can\'t test in / as work directory'); }
--FILE--
<?php
$cwd = posix_getcwd();
var_dump(strlen($cwd) > 1);
chroot($cwd);
var_dump('/' === posix_getcwd());
var_dump($cwd  === posix_getcwd());
--EXPECTF--
bool(true)
bool(true)
bool(false)
--CREDITS--
Roy Kaldung, roy@kaldung.com
PHP Testfest Berlin 8/29/2010
