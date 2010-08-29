--TEST--
DOMDocumentType: basic create document type
based on doc comment

--SKIPIF--
<?php require_once('skipif.inc'); ?>
--FILE--
<?php
$impl = new DOMImplementation;
// Creates a DOMDocumentType instance
$doctype = $impl->createDocumentType('graph', '', 'graph.dtd');

// Creates a DOMDocument instance
$dom = $impl->createDocument("", "", $doctype);

// Creates a DOMElement
$element = $dom->createElement("graph");

// Append Element to DOM
$dom->appendChild($element);

// RESULT
echo $dom->saveXML();
?>
--EXPECT--
<?xml version="1.0"?>
<!DOCTYPE graph SYSTEM "graph.dtd">
<graph/>
--CREDITS--
Moritz Neuhaeuser, info@xcompile.net
PHP Testfest Berlin 2009-05-09
