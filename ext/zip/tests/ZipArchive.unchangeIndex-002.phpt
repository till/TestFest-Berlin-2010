--TEST--
ZipArchive::unchangeIndex(): False on index < 0
--FILE--
<?php
$zip = new ZipArchive;
$zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE);
var_dump($zip->unchangeIndex(-1));
--EXPECT--
bool(false)
--CLEAN--
@unlink(dirname(__FILE__) . '/foo.zip');
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
