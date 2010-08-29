--TEST--
Test function getprotobynumber() by calling it with its expected arguments
--FILE--
<?php
var_dump(getprotobynumber(0));
var_dump(getprotobynumber(1));
var_dump(getprotobynumber(3));
var_dump(getprotobynumber(6));
var_dump(getprotobynumber(8));
var_dump(getprotobynumber(12));
var_dump(getprotobynumber(17));
var_dump(getprotobynumber(20));
var_dump(getprotobynumber(22));
var_dump(getprotobynumber(27));
var_dump(getprotobynumber(66));
?>
--EXPECTF--
string(2) "ip"
string(4) "icmp"
string(3) "ggp"
string(3) "tcp"
string(3) "egp"
string(3) "pup"
string(3) "udp"
string(3) "hmp"
string(7) "xns-idp"
string(3) "rdp"
string(3) "rvd"
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29