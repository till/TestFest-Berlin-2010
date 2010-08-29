--TEST--
bcscale() incorrect argument count
--SKIPIF--
<?php if(! extension_loaded('bcmath')) print 'skip'; ?>
--INI--
bcmath.scale=0
--FILE--
<?php
var_dump(bcscale());
?>
--EXPECTF--
Warning: bcscale() expects exactly 1 parameter, 0 given in %s on line %d
NULL
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29