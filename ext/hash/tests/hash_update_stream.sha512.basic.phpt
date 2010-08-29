--TEST--
basic test for hash_update_stream
--CREDITS--
Fabian Blechschmidt Fabian.Blech@gmx.de
PHP TestFest Berlin 2010-08-29
--FILE--
<?php
$fp = tmpfile();
fwrite($fp, 'Franz jagt im komplett verwahrlosten Taxi quer durch Bayern.');
rewind($fp);
$ctx1 = hash_init('sha512');
var_dump(hash_update_stream($ctx1, $fp));
var_dump(hash_final($ctx1));
fclose($fp);

$fp1 = tmpfile();
$fp2 = tmpfile();
fwrite($fp1, 'Franz jagt im komplett ');
fwrite($fp2, 'verwahrlosten Taxi quer durch Bayern.');
rewind($fp1);
rewind($fp2);
$ctx2 = hash_init('sha512');
var_dump(hash_update_stream($ctx2, $fp1));
var_dump(hash_update_stream($ctx2, $fp2));
var_dump(hash_final($ctx2));
?>
--EXPECT--
int(60)
string(128) "dc3f01df995dd817f18596b6a0523b051d51191c347909cd2c333ca97d8c8d95501a25555760fa4d93968ddf76f458e7119aa0ec312b924dc4ec567ab973a8d7"
int(23)
int(37)
string(128) "dc3f01df995dd817f18596b6a0523b051d51191c347909cd2c333ca97d8c8d95501a25555760fa4d93968ddf76f458e7119aa0ec312b924dc4ec567ab973a8d7"

