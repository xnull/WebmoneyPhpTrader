<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}

class HtmlTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testInput() {
		$input = new HTML_Element('input');
		$input->addAttr('type', 'text')->addAttr('name', "myInput");
		$input->addAttr("id", "123");
		
		$this->assertEqual($input->getAttr('name'), 'myInput');
		$this->assertEqual($input->getAttr('type'), 'text');
		
	}

	function testSelect() {
		$select = new HTML_Element('select');
		$select->addAttr("name", "mySelect");
		$opt = new HTML_Element('option');
		$opt->addAttr("value", "you");
		$select->addChild($opt);
		$this->assertEqual($select->getAttr('name'), 'mySelect');		
	}
}

?>
