--TEST--
basic test for hash_update_stream
--CREDITS--
Fabian Blechschmidt Fabian.Blech@gmx.de
PHP TestFest Berlin 2010-08-29
--FILE--
<?php
$ctx1 = hash_init('sha512');
// File doesn't exists... should throw an Error
var_dump(hash_update_file($ctx1, 'test.txt'));

file_put_contents('test1.txt', 'Franz jagt im komplett verwahrlosten Taxi quer durch Bayern.');

$ctx2 = hash_init('sha512');
var_dump(hash_update_file($ctx2, fopen('test1.txt', 'r')));
var_dump(hash_final($ctx2));
?>
--EXPECTF--
bool(false)

Warning: hash_update_file() expects parameter 2 to be string, resource given in %shash_update_file.error.php on line %d
NULL
string(128) "cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e"
