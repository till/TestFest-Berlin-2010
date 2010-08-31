--TEST--
SQLite3::busyTimeout
--SKIPIF--
<?php
if (!extension_loaded('sqlite3') || version_compare(phpversion(), '5.3.3', '<')) {
  die('skip');
}
--FILE--
<?php
$db = new SQLite3(':memory:');

var_dump($db->busyTimeout(1));
var_dump($db->busyTimeout(0));
var_dump($db->busyTimeout(-1));
--EXPECTF--
bool(true)
bool(true)
bool(true)
--CREDITS--
Robin Mehner, robin@coding-robin.de
TestFest 2010 Berlin, 2010/08/29
