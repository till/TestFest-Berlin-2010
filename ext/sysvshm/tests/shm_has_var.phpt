--TEST--
shm_has_var on existing and non existing entry

--SKIPIF--
<?php 
    if (!extension_loaded('sysvshm')) print 'skip sysvsem extension not available';
?>
--FILE--
<?php

$shm = shm_attach(42);

shm_put_var($shm, 7, "bar");
var_dump( shm_has_var($shm, 7) );
var_dump( shm_has_var($shm, 14) );

?>
--EXPECT--
bool(true)
bool(false)
--CREDITS--
Daniel Fahlke, flyingmana@googlemail.com
PHP Testfest Berlin 2010
