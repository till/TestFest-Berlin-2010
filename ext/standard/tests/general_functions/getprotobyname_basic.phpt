--TEST--
Test function getprotobyname() by calling it with its expected arguments
--FILE--
<?php
var_dump(getprotobyname('ip'));
var_dump(getprotobyname('icmp'));
var_dump(getprotobyname('ggp'));
var_dump(getprotobyname('tcp'));
var_dump(getprotobyname('egp'));
var_dump(getprotobyname('pup'));
var_dump(getprotobyname('udp'));
var_dump(getprotobyname('hmp'));
var_dump(getprotobyname('xns-idp'));
var_dump(getprotobyname('rdp'));
var_dump(getprotobyname('rvd'));
?>
--EXPECTF--
int(0)
int(1)
int(3)
int(6)
int(8)
int(12)
int(17)
int(20)
int(22)
int(27)
int(66)
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29