--TEST--
Test function pdo_drivers() by calling it with its expected arguments
--SKIPIF--
<?php if(! extension_loaded('pdo')) print 'extension pdo not loaded'; ?>
--FILE--
<?php
$aPdoDrivers = pdo_drivers();

var_dump(is_array($aPdoDrivers));

foreach (array_keys($aPdoDrivers) as $mKey) {
    if ('integer' != gettype($mKey)) {
        echo 'invalid key type: ' . gettype($mKey) . PHP_EOL;
    }
    if ('string' != gettype($aPdoDrivers[$mKey])) {
        echo 'invalid value type: ' . gettype($aPdoDrivers[$mKey]) . PHP_EOL;
    }
}
echo 'test passed' . PHP_EOL;
?>
--EXPECTF--
bool(true)
test passed
--CREDITS--
Kai Schröder, k.schroeder@php.net
PHP TestFest Berlin 2010-08-29