--TEST--
SQLite3::busyTimeout wrong parameters
--SKIPIF--
<?php
if (!extension_loaded('sqlite3')) {
  die('skip');
}
--FILE--
<?php
$db = new SQLite3(':memory:');

var_dump($db->busyTimeout());
var_dump($db->busyTimeout(array()));
var_dump($db->busyTimeout('string'));
--EXPECTF--
Warning: SQLite3::busyTimeout() expects exactly 1 parameter, 0 given in %s on line %d
NULL

Warning: SQLite3::busyTimeout() expects parameter 1 to be long, array given in %s on line %d
NULL

Warning: SQLite3::busyTimeout() expects parameter 1 to be long, string given in %s on line %d
NULL
--CREDITS--
Robin Mehner, robin@coding-robin.de
TestFest 2010 Berlin, 2010/08/29
