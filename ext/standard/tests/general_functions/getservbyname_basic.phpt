--TEST--
Test function getservbyname() by calling it with its expected arguments
--FILE--
<?php
var_dump(getservbyname('daytime', 'tcp'));
var_dump(getservbyname('daytime', 'udp'));
var_dump(getservbyname('does_not_exists', 'tcp'));
var_dump(getservbyname('does_not_exists', 'udp'));
var_dump(getservbyname('does_not_exists', 'does_not_exists'));
?>
--EXPECTF--
int(13)
int(13)
bool(false)
bool(false)
bool(false)
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29