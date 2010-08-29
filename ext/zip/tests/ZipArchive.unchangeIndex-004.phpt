--TEST--
ZipArchive::unchangeIndex(): Return false if the internal index and the supplied differ.
--FILE--
<?php
$zip = new ZipArchive;
$zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE);
var_dump($zip->unchangeIndex(10)); // just supply an unknown
--EXPECT--
bool(false)
--SKIPIF--
<?php if(!extension_loaded('zip')) die('skip'); ?>
--CLEAN--
<?php @unlink(dirname(__FILE__) . '/foo.zip'); ?>
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
