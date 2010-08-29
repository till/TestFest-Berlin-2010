--TEST--
Test function pdo_drivers() by calling it with its expected arguments
--FILE--
<?php
var_dump(pdo_drivers());
?>
--EXPECTF--
array(4) {
  [0]=>
  string(5) "mysql"
  [1]=>
  string(4) "odbc"
  [2]=>
  string(6) "sqlite"
  [3]=>
  string(7) "sqlite2"
}
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29