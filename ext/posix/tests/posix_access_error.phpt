--TEST--
error test for posix_access()
--DESCRIPTION--
checks for existence, read-access, write-access, execute-access
--CREDITS--
PHP Testfest 2010 Berlin
Andreas Mauf <hello@amauf.de>
--SKIPIF--
<?php
if (!extension_loaded('posix')) {
    die('SKIP The posix extension is not loaded.');
}
if (posix_geteuid() == 0) {
    die('SKIP Cannot run test as root.');
}
--FILE--
<?php
$filename = dirname(__FILE__) . '/foo.test';
var_dump(posix_access($filename, POSIX_F_OK));
$fp = fopen($filename,"w");
fwrite($fp,"foo");
fclose($fp);

chmod ($filename, 0000);
var_dump(posix_access($filename, POSIX_R_OK));
var_dump(posix_access($filename, POSIX_W_OK));
var_dump(posix_access($filename, POSIX_X_OK));
--CLEAN--
<?php
$filename = dirname(__FILE__) . '/foo.test';
chmod ($filename, 0700);
unlink($filename);
--EXPECTF--
bool(false)
bool(false)
bool(false)
bool(false)
