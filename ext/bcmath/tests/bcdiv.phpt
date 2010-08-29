--TEST--
bcdiv() function
--SKIPIF--
<?php if(!extension_loaded('bcmath')) print 'skip'; ?>
--INI--
bcmath.scale=0
--FILE--
<?php
var_dump(bcdiv('1', '2'));
var_dump(bcdiv('1', '2', 2));
var_dump(bcdiv('-1', '5', 4));
var_dump(bcdiv('8728932001983192837219398127471', '1928372132132819737213', 2));
var_dump(bcdiv('1', '3', 2));
?>
--EXPECT--
string(1) "0"
string(4) "0.50"
string(7) "-0.2000"
string(13) "4526580661.75"
string(4) "0.33"
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29