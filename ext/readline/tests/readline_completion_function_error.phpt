--TEST--
readline_completion_function(): Error Handling
--SKIPIF--
<?php if (!extension_loaded("readline")) die("skip"); ?>
--FILE--
<?php
var_dump(readline_completion_function());
--EXPECTF--
Warning: readline_completion_function() expects exactly 1 parameter, 0 given in %s/readline_completion_function_error.php on line %d
bool(false)
--CREDITS--
Robin Mehner, robin@coding-robin.de
TestFest 2010 Berlin, 2010/08/29