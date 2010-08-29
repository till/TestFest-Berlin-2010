--TEST--
SQLite3::escapeString wrong parameter handling
--SKIPIF--
<?php require_once(dirname(__FILE__) . '/skipif.inc');
--FILE--
<?php
require_once(dirname(__FILE__) . '/new_db.inc');
var_dump($db->escapeString(array()));
var_dump($db->escapeString());
--EXPECTF--
Warning: SQLite3::escapeString() expects parameter 1 to be string, array given in %s on line %d
NULL

Warning: SQLite3::escapeString() expects exactly 1 parameter, 0 given in %s on line %d
NULL
--CREDITS--
Robin Mehner, robin@coding-robin.de
TestFest 2010 Berlin, 2010/08/29
