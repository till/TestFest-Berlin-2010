--TEST--
ZipArchive::unchangeIndex(): Warning when index is not a long.
--FILE--
<?php
$zip = new ZipArchive;
$zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE);
$zip->unchangeIndex('foo');
--EXPECTF--
Warning: ZipArchive::unchangeIndex() expects parameter 1 to be long, string given in %s on line %d
--SKIPIF--
<?php if(!extension_loaded('zip')) die('skip'); ?>
--CLEAN--
<?php @unlink(dirname(__FILE__) . '/foo.zip'); ?>
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
