--TEST--
DOMDocumentType: basic create document type
based on doc comment

--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$impl = new DOMImplementation;
// Creates a DOMDocumentType instance
$doctype = $impl->createDocumentType('html', '-//W3C//DTD XHTML 1.0 Transitional//EN', 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd');

// Creates a DOMDocument instance
$dom = $impl->createDocument("", "", $doctype);

// Creates a DOMElement
$element = $dom->createElement("html");

// Append Element to DOM
$dom->appendChild($element);

// RESULT
echo $dom->saveXML();
?>

--EXPECT--
<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"></html>

--CREDITS--
Moritz Neuhaeuser, info@xcompile.net
PHP Testfest Berlin 2010
