--TEST--
ZipArchive::deleteName(): Failure with missing parameter.
--FILE--
<?php
$zip = new ZipArchive;
$zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE);
$zip->deleteName();
--EXPECTF--
Warning: ZipArchive::deleteName() expects exactly 1 parameter, 0 given in %s/ZipArchive.deleteName-002.php on line 4
--CLEAN--
@unlink(dirname(__FILE__) . '/foo.zip');
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
