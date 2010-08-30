--TEST--
SQLite3::querySingle error handling
--SKIPIF--
<?php
if (!extension_loaded('sqlite3')) {
  die('skip');
}
--FILE--
<?php
$db = new SQLite3(':memory:');

var_dump($db->querySingle('INVALID QUERY'));
--EXPECTF--
Warning: SQLite3::querySingle(): Unable to prepare statement: 1, near "INVALID": syntax error in %s on line %d
bool(false)
--CREDITS--
Robin Mehner, robin@coding-robin.de
TestFest 2010 Berlin, 2010/08/29
