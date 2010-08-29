--TEST--
Test mb_check_encoding - error test
--CREDITS--
Fabian Blechschmidt Fabian.Blech@gmx.de
#PHP TestFest 2010 Berlin

--SKIPIF--
<?php
extension_loaded('mbstring') or die('skip');
function_exists('mb_ereg') or die("skip mb_check_encoding() is not available in this build");
?>
--FILE--
<?php
echo '//try an int - it will be converted to string and fit in any encoding'."\n";
$int = 4711;
var_dump(mb_check_encoding($int, 'utf-8'));
var_dump(mb_check_encoding($int, 'ISO-8859-1'));


echo '// same here, float will be converted...'."\n";
$float = 42.42;
var_dump(mb_check_encoding($float, 'utf-8'));
var_dump(mb_check_encoding($float, 'ISO-8859-1'));

echo '// what happens with a stream?';
file_put_contents('test.txt', 'blabla ... any text');
$stream = fopen('test.txt', 'r');
var_dump(mb_check_encoding($stream, 'utf-8'));
var_dump(mb_check_encoding($stream, 'ISO-8859-1'));


/*
echo '// "german" string in UTF-8'."\n";
$translatable_string = 'äöüß';
var_dump(mb_check_encoding($translatable_string, 'utf-8'));
var_dump(mb_check_encoding($translatable_string, 'ISO-8859-1'));

echo '//"german" string in ISO'."\n";
$translated_string = iconv('UTF-8', 'ISO-8859-1', $translatable_string);
var_dump(mb_check_encoding($translated_string, 'utf-8'));
var_dump(mb_check_encoding($translated_string, 'ISO-8859-1'));

echo '// japanese string in ISO-2022'."\n";
$trans_jp_string = iconv('UTF-8', 'ISO-2022-JP', $jp_string);
var_dump(mb_check_encoding($trans_jp_string, 'utf-8'));
var_dump(mb_check_encoding($trans_jp_string, 'ISO-8859-1'));
var_dump(mb_check_encoding($trans_jp_string, 'ISO-2022-JP'));

 */
?>

--EXPECTF--
//try an int - it will be converted to string and fit in any encoding
bool(true)
bool(true)
// same here, float will be converted...
bool(true)
bool(true)
// what happens with a stream?
Warning: mb_check_encoding() expects parameter 1 to be string, resource given in %smb_check_encoding.error.php on line %d
bool(false)

Warning: mb_check_encoding() expects parameter 1 to be string, resource given in %smb_check_encoding.error.php on line %d
bool(false)