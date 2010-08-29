--TEST--
basic test for hash_update_stream
--CREDITS--
Fabian Blechschmidt Fabian.Blech@gmx.de
PHP TestFest Berlin 2010-08-29
--FILE--
<?php
file_put_contents('test.txt', 'Franz jagt im komplett verwahrlosten Taxi quer durch Bayern.');

$ctx1 = hash_init('sha512');
var_dump(hash_update_file($ctx1, 'test.txt'));

file_put_contents('test1.txt', 'Franz jagt im komplett ');
file_put_contents('test2.txt', 'verwahrlosten Taxi quer durch Bayern.');

$ctx2 = hash_init('sha512');
var_dump(hash_update_file($ctx2, 'test1.txt'));
var_dump(hash_update_file($ctx2, 'test2.txt'));
var_dump(hash_final($ctx2));
?>
--EXPECT--
bool(true)
bool(true)
bool(true)
string(128) "dc3f01df995dd817f18596b6a0523b051d51191c347909cd2c333ca97d8c8d95501a25555760fa4d93968ddf76f458e7119aa0ec312b924dc4ec567ab973a8d7"
--CLEAN--
unlink('test.txt');
unlink('test1.txt');
unlink('test2.txt');