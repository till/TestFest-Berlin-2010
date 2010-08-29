--TEST--
test DirectoryIterator::getPerms 
--SKIPIF--
--FILE--
<?php
$tmpdir = tempnam(sys_get_temp_dir(), 'PHPT_');
unlink($tmpdir);
mkdir($tmpdir);

$rights = array(
	0600, 0660, 0666, 0755, 0700, 0750, 0755
);
$perms2check = array();
foreach($rights as $right) {
	$file = tempnam($tmpdir, '');
	chmod($file, $right);
	$perms2check[basename($file)] = $right;
}
$dir = new DirectoryIterator($tmpdir);
foreach($dir as $entry) {
	if (!$entry->isDot()) {
		var_dump(decoct($perms2check[$entry->getFilename()])  == substr(decoct($entry->getPerms()), -3));
		unlink($tmpdir . '/' . $entry->getFilename());
	}
}
rmdir($tmpdir);
--EXPECTF--
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
--CREDITS--
Roy Kaldung, roy@kaldung.com
PHP Testfest Berlin 8/29/2010
