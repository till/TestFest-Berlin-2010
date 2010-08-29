--TEST--
ZipArchive::extractTo(): Return 'true' and issue a warning when files parameter has incorrect type.
--FILE--
<?php
$zip = new ZipArchive;
$zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE);
var_dump($zip->extractTo('./', 1));
--EXPECTF--
Warning: ZipArchive::extractTo(): Invalid argument, expect string or array of strings in %s on line %d
bool(true)
--SKIPIF--
<?php if(!extension_loaded('zip')) die('skip'); ?>
--CLEAN--
<?php @unlink(dirname(__FILE__) . '/foo.zip'); ?>
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
