--TEST--
SQLite3::escapeString returns empty string on values without length
--SKIPIF--
<?php require_once(dirname(__FILE__) . '/skipif.inc');
--FILE--
<?php
require_once(dirname(__FILE__) . '/new_db.inc');
var_dump($db->escapeString(null));
var_dump($db->escapeString(false));
--EXPECT--
string(0) ""
string(0) ""
--CREDITS--
Robin Mehner, robin@coding-robin.de
TestFest 2010 Berlin, 2010/08/29
