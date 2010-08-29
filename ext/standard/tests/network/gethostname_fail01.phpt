--TEST--
basic test for gethostname
--FILE--
<?php
echo strlen(gethostname())<strlen(php_uname());
--EXPECTF--
1
--CREDITS--
Roy Kaldung, roy@kaldung.com
PHP Testfest Berlin 8/29/2010
