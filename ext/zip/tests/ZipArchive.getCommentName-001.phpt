--TEST--
ZipArchive::getCommentName(): Return 'false' on unknown comment name.
--FILE--
<?php
$zip = new ZipArchive;
$zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE);
var_dump($zip->getCommentName('foobar'));
--EXPECT--
bool(false)
--SKIPIF--
<?php if(!extension_loaded('zip')) die('skip'); ?>
--CLEAN--
<?php @unlink(dirname(__FILE__) . '/foo.zip'); ?>
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
