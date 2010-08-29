--TEST--
SQLite3::querySingle error handling
--SKIPIF--
<?php require_once(dirname(__FILE__) . '/skipif.inc');
--FILE--
<?php
require_once(dirname(__FILE__) . '/new_db.inc');

var_dump($db->querySingle('INVALID QUERY'));
--EXPECTF--
Warning: SQLite3::querySingle(): Unable to prepare statement: 1, near "INVALID": syntax error in %s on line %d
bool(false)
--CREDITS--
Robin Mehner, robin@coding-robin.de
TestFest 2010 Berlin, 2010/08/29
