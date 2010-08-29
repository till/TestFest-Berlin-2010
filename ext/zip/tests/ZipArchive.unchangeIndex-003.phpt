--TEST--
ZipArchive::unchangeIndex(): Warning when index is not a long.
--FILE--
<?php
$zip = new ZipArchive;
$zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE);
$zip->unchangeIndex('foo');
--EXPECTF--
Warning: ZipArchive::unchangeIndex() expects parameter 1 to be long, string given in %s/ZipArchive.unchangeIndex-003.php on line 4
--CLEAN--
@unlink(dirname(__FILE__) . '/foo.zip');
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
