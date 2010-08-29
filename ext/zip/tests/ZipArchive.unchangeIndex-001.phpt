--TEST--
ZipArchive::unchangeIndex(): Warning when no argument is supplied.
--FILE--
<?php
$zip = new ZipArchive;
$zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE);
$zip->unchangeIndex();
--EXPECTF--
Warning: ZipArchive::unchangeIndex() expects exactly 1 parameter, 0 given in %s/ZipArchive.unchangeIndex-001.php on line 4
--CLEAN--
@unlink(dirname(__FILE__) . '/foo.zip');
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
