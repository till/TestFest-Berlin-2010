--TEST--
basic test for chroot
--SKIPIF--
<?php
// test doesn't run unter windows
if('WIN' === substr(PHP_OS, 0, 3)) { die('skip'); }
// has to be root to chroot()
if (0 != posix_getuid()) { die('skip'); }
// test can't be run with / as work directory
if ('/' === posix_cwd()) { die('skip'); }
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
