--TEST--
ZipArchive::unchangeIndex(): Return 'true' when we can rollback.
--DESCRIPTION--
Unless save() is called in between, unchangeIndex() rolls back to the archive's
initial state.

So when I create an archive, add a file to it and unchange on the file's index (in a
single run), so last operation on the index should return 'false' since the index
did intially not exist.

During the operation, the various states are tested.
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
var_dump($zip->getNameIndex($idx));
var_dump($zip->unchangeIndex($idx));
var_dump($zip->getNameIndex($idx));
$zip->close();
--SKIPIF--
<?php if(!extension_loaded('zip')) die('skip'); ?>
--EXPECTF--
int(0)
string(%d) "%s/testFile.txt"
string(12) "testFile.txt"
bool(true)
bool(true)
string(13) "testFile2.txt"
bool(true)
bool(false)
--CLEAN--
<?php @unlink(dirname(__FILE__) . '/foo.zip'); ?>
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
