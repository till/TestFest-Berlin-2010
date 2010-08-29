--TEST--
ZipArchive::deleteName(): Failure with missing parameter.
--FILE--
<?php
$zip = new ZipArchive;
$zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE);
$zip->deleteName();
--EXPECTF--
Warning: ZipArchive::deleteName() expects exactly 1 parameter, 0 given in %s on line %d
--SKIPIF--
<?php if(!extension_loaded('zip')) die('skip'); ?>
--CLEAN--
<?php @unlink(dirname(__FILE__) . '/foo.zip'); ?>
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
