<?php

if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}


class DoubleTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}
	
	function testToDouble(){
		$this->assertEqual(Core_Double::toDouble(123.5), 123.5);
		$this->assertEqual(Core_Double::toDouble('123.5'), 123.5);
		$this->assertEqual(Core_Double::toDouble('123,5'), 123.5);
		$this->assertEqual(Core_Double::toDouble(-123.5), -123.5);
		$this->assertEqual(Core_Double::toDouble('-123.5'), -123.5);
	}
}

?>