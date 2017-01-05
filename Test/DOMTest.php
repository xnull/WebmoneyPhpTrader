<?php

include_once 'simpletest/autorun.php';

class DOMTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}
	
	public function testGetNodeName(){
		$dom = new DOMDocument();
		$myNode1 = $dom->createElement("myNode1");		
		$dom->appendChild($myNode1);
		$myNode1->setAttribute("myAttr1", "attr1");
		$this->assertEqual($dom->getElementsByTagName("myNode1")->item(0)->nodeName, "myNode1");
		$this->assertEqual($dom->getElementsByTagName("myNode1")->item(0)->attributes->item(0)->name, "myAttr1");
		$this->assertEqual($dom->getElementsByTagName("myNode1")->item(0)->attributes->item(0)->value, "attr1");
	}

	function testDomLoadXML(){
		$dom = new DOMDocument();
		$dom->loadXML('<?xml version="1.0"?> <root/>');
		/**
		 * $this->assertEqual($dom->saveXML(), '<?xml version="1.0"?> <root/>', $dom->saveXML());
		 */
	}
}
