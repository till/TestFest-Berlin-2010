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
$ctx = hash_init('md5');
hash_update_stream($ctx);
hash_update_stream($ctx, 'lala');
hash_update_stream();
var_dump(hash_final($ctx));
fclose($fp);
?>
--EXPECTF--
Warning: hash_update_stream() expects at least 2 parameters, 1 given in %shash_update_stream.error.php on line %d

Warning: hash_update_stream() expects parameter 2 to be resource, string given in %shash_update_stream.error.php on line %d

Warning: hash_update_stream() expects at least 2 parameters, 0 given in %shash_update_stream.error.php on line %d
string(32) "d41d8cd98f00b204e9800998ecf8427e"
