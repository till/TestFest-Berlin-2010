--TEST--
ZipArchive::unchangeIndex(): Return 'true' when we can rollback.
--FILE--
<?php
$file = dirname(__FILE__) . '/testFile.txt';
$idx  = 0;
$name = basename($file);

var_dump($idx, $file, $name);

$zip = new ZipArchive;
$zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE);

var_dump($zip->addFile($file, $name));
var_dump($zip->renameIndex(0, 'testFile2.txt'));
var_dump($zip->unchangeIndex($idx));

$zip->close();
--EXPECTF--
int(0)
string(%d) "%s/testFile.txt"
string(12) "testFile.txt"
bool(true)
bool(true)
bool(true)
--CLEAN--
@unlink(dirname(__FILE__) . '/foo.zip');
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
