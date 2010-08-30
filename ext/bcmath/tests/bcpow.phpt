--TEST--
bcpow() function
--SKIPIF--
<?php if(!extension_loaded('bcmath')) print 'skip'; ?>
--INI--
bcmath.scale=0
--FILE--
<?php
var_dump(bcpow('1', '2'));
var_dump(bcpow('-2', '5'));
var_dump(bcpow('2', '64'));
?>
--EXPECT--
string(1) "1"
string(3) "-32"
string(20) "18446744073709551616"
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29