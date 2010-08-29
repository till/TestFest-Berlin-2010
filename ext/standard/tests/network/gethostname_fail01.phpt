--TEST--
basic test for gethostname
--FILE--
<?php
var_dump(strlen(gethostname())<strlen(php_uname()));
--EXPECTF--
bool(true)
--CREDITS--
Roy Kaldung, roy@kaldung.com
PHP Testfest Berlin 8/29/2010
