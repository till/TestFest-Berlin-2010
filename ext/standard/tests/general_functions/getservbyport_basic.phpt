--TEST--
Test function getservbyport() by calling it with its expected arguments
--FILE--
<?php
var_dump(getservbyport(13, 'tcp'));
var_dump(getservbyport(13, 'udp'));
var_dump(getservbyport(23, 'tcp'));
var_dump(getservbyport(23, 'udp'));
var_dump(getservbyport(369, 'tcp'));
var_dump(getservbyport(369, 'udp'));
var_dump(getservbyport(1167, 'tcp'));
var_dump(getservbyport(1167, 'udp'));
?>
--EXPECTF--
string(7) "daytime"
string(7) "daytime"
string(6) "telnet"
bool(false)
bool(false)
bool(false)
bool(false)
string(5) "phone"
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29