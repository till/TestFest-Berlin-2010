--TEST--
bcpowmod() - Raise an arbitrary precision number to another, reduced by a specified modulus
--SKIPIF--
<?php if(!extension_loaded('bcmath')) print 'skip'; ?>
--INI--
bcmath.scale=0
--FILE--
<?php
var_dump(bcpowmod('5', '2', '7'));
var_dump(bcpowmod('-2', '5', '7'));
var_dump(bcpowmod('10', '2147483648', '2047'));
var_dump(bcpowmod('5', '2', '0'));
var_dump(bcpowmod('5', '4', '3'));
var_dump(bcpowmod('5', '4', '3', 2));
?>
--EXPECT--
string(1) "4"
string(2) "-4"
string(3) "790"
bool(false)
string(1) "1"
string(4) "1.00"
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29