--TEST--
ZipArchive::locateName(): Returns false when unknown file in archive is requested.
--FILE--
<?php
$zip = new ZipArchive;
var_dump($zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE));
var_dump($zip->locateName('foo'));
--EXPECTF--
bool(true)
bool(false)
--CLEAN--
@unlink(dirname(__FILE__) . '/foo.zip');
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
