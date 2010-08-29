--TEST--
ZipArchive::setCommentName(): Issues a warning when 'name' is empty.
--FILE--
<?php
$zip = new ZipArchive;
$zip->open(dirname(__FILE__) . '/foo.zip', ZIPARCHIVE::CREATE);
$zip->setCommentName('', 'foobar');
--EXPECTF--
Notice: ZipArchive::setCommentName(): Empty string as entry name in %s/ZipArchive.setCommentName-001.php on line 4
--CLEAN--
@unlink(dirname(__FILE__) . '/foo.zip');
--CREDITS--
Till Klampaeckel <till@php.net>
PHP Testfest Berlin 8/29/2010
