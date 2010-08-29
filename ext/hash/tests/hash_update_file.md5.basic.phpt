--TEST--
basic test for hash_update_stream
--CREDITS--
Fabian Blechschmidt Fabian.Blech@gmx.de
PHP TestFest Berlin 2010-08-29
--FILE--
<?php
file_put_contents('test.txt', 'Franz jagt im komplett verwahrlosten Taxi quer durch Bayern.');

$ctx1 = hash_init('md5');
var_dump(hash_update_file($ctx1, 'test.txt'));

file_put_contents('test1.txt', 'Franz jagt im komplett ');
file_put_contents('test2.txt', 'verwahrlosten Taxi quer durch Bayern.');

$ctx2 = hash_init('md5');
var_dump(hash_update_file($ctx2, 'test1.txt'));
var_dump(hash_update_file($ctx2, 'test2.txt'));
var_dump(hash_final($ctx2));
?>
--EXPECT--
bool(true)
bool(true)
bool(true)
string(32) "ba4b9da310763a91f8edc7c185a1e4bf"
--CLEAN--
unlink('test.txt');
unlink('test1.txt');
unlink('test2.txt');