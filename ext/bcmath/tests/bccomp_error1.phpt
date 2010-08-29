--TEST--
bccomp() incorrect argument count
--SKIPIF--
<?php if(! extension_loaded('bcmath')) print 'skip'; ?>
--INI--
bcmath.scale=0
--FILE--
<?php
var_dump(bccomp());
var_dump(bccomp('1'));
?>
--EXPECTF--
Warning: bccomp() expects at least 2 parameters, 0 given in %s on line %d
NULL

Warning: bccomp() expects at least 2 parameters, 1 given in %s on line %d
NULL
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29