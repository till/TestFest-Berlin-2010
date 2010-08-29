--TEST--
DOMDocumentType: error create document type
based on doc comment

--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$impl = new DOMImplementation;
// Wrong argument count
$impl->createDocumentType('-//W3C//DTD XHTML 1.0 Transitional//EN', 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd');

$impl->createDocumentType('html','-//W3C//DTD XHTML 1.0 Transitional//EN', 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd',null);

// check for qualifiedName Warning
$impl->createDocumentType('','-//W3C//DTD XHTML 1.0 Transitional//EN', 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd');


// TODO check opaque uri i.e. mailto:foo@bar.baz
?>

--EXPECTF--
Warning: DOMImplementation::createDocumentType() expects at most 3 parameters, 4 given in %s on line %i

Warning: DOMImplementation::createDocumentType(): qualifiedName is required in %s on line %i
--CREDITS--
Moritz Neuhaeuser, info@xcompile.net
PHP Testfest Berlin 2010
