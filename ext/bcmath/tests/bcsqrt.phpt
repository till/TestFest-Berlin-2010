--TEST--
bcsqrt() function
--SKIPIF--
<?php if(! extension_loaded('bcmath')) print 'skip'; ?>
--INI--
bcmath.scale=0
--FILE--
<?php
var_dump(bcsqrt('0'));
var_dump(bcsqrt('1'));
var_dump(bcsqrt('9'));
var_dump(bcsqrt('1928372132132819737213'));
var_dump(bcsqrt('3', 5));
?>
--EXPECT--
string(1) "0"
string(1) "1"
string(1) "3"
string(11) "43913234134"
string(7) "1.73205"
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29