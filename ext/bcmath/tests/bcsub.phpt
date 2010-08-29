--TEST--
bcsub() function
--SKIPIF--
<?php if(!extension_loaded("bcmath")) print "skip"; ?>
--INI--
bcmath.scale=0
--FILE--
<?php
var_dump(bcsub('1', '2'));
var_dump(bcsub('-1', '5', 4));
var_dump(bcsub('8728932001983192837219398127471', '1928372132132819737213', 2));
var_dump(bcsub('1.234', '5', 1));
var_dump(bcsub('1.234', '5', 3));
var_dump(bcsub('1.234', '5', 5));
?>
--EXPECT--
string(2) "-1"
string(7) "-6.0000"
string(34) "8728932000054820705086578390258.00"
string(4) "-3.7"
string(6) "-3.766"
string(8) "-3.76600"
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29