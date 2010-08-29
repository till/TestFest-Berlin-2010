--TEST--
Test mb_check_encoding - basic functionality
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
echo '// String from japan in UTF-8'."\n";
$jp_string = 'を始めよう ボキャブラリ コンテンツ';
var_dump(mb_check_encoding($jp_string, 'utf-8'));
var_dump(mb_check_encoding($jp_string, 'ISO-8859-1'));

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
?>

--EXPECT--
// String from japan in UTF-8
bool(true)
bool(false)
// "german" string in UTF-8
bool(true)
bool(false)
//"german" string in ISO
bool(false)
bool(true)
// japanese string in ISO-2022
bool(false)
bool(false)
bool(true)
