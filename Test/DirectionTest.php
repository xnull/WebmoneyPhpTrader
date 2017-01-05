<?php

//$testGlobal = realpath(dirname(__FILE__) . '/__TestGlobals.php');
include_once '__TestGlobals.php'; //$testGlobal;


class DirectionTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testGetExchTypeFromDirection() {
		$this->assertEqual(Exchanger_Direction::getReverseDirection("WMZ_WMR"), "WMR_WMZ");
		$this->assertEqual(Exchanger_Direction::getReverseExchType("1"), "2");
	}

	function testgetReverseExchType(){
		$this->assertEqual(Exchanger_Direction::getReverseExchType(1), 2);
		$this->assertEqual(Exchanger_Direction::getReverseExchType(2), 1);
		$this->assertEqual(Exchanger_Direction::getReverseExchType(3), 4);
		$this->assertEqual(Exchanger_Direction::getReverseExchType(4), 3);
	}
}
?>
