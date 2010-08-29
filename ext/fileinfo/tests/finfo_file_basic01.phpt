--TEST--
Basic test for fileinfo_file
--FILE--
<?php
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    echo finfo_file($finfo, __DIR__.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'empty')."\n";
    echo finfo_file($finfo, __DIR__.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'test.txt')."\n";
    echo finfo_file($finfo, __DIR__.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'test.php')."\n";
    echo finfo_file($finfo, __DIR__.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'test.inc')."\n";
    echo finfo_file($finfo, __DIR__.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'test.css')."\n";
    echo finfo_file($finfo, __DIR__.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'test.js')."\n";
    finfo_close($finfo);
--EXPECT--
application/x-empty
text/plain
text/x-php
text/x-php
text/plain
text/plain
--CREDITS--
Ruediger Scheumann, info@ruediger-scheumann.de
PHP TestFest 2010 Berlin
tested using Ubuntu 10.04

