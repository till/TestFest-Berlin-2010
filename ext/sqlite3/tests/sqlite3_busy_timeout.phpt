--TEST--
SQLite3::busyTimeout
--SKIPIF--
<?php require_once(dirname(__FILE__) . '/skipif.inc');
--FILE--
<?php
require_once(dirname(__FILE__) . '/new_db.inc');

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
