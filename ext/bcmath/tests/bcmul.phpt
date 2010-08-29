--TEST--
bcmul() function
--SKIPIF--
<?php if(!extension_loaded("bcmath")) print "skip"; ?>
--INI--
bcmath.scale=0
--FILE--
<?php
var_dump(bcmul('1', '2'));
var_dump(bcmul('-3', '5'));
var_dump(bcmul('1234567890', '9876543210'));
var_dump(bcmul('2.5', '1.5', 2));
var_dump(bcmul('1.23', '4.56', 3));
?>
--EXPECT--
string(1) "2"
string(3) "-15"
string(20) "12193263111263526900"
string(4) "3.75"
string(5) "5.608"
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29