<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}


class ComissionTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testMinComission() {
		$this->assertEqual(Webmoney_Comission::checkMinComission(0.1), 0.1);
		$this->assertEqual(Webmoney_Comission::checkMinComission(0.01), 0.01);
		$this->assertEqual(Webmoney_Comission::checkMinComission(0.001), 0.01);
		$this->assertEqual(Webmoney_Comission::checkMinComission(0.008), 0.01);
		$this->assertEqual(Webmoney_Comission::checkMinComission(0.076), 0.08);
		$this->assertEqual(Webmoney_Comission::checkMinComission(0.2), 0.2);
	}

	function testMaxComission() {
		$comm = new Webmoney_Comission();

		$this->assertEqual(Webmoney_Comission::checkMaxComission('WMZ', 10), 10, Webmoney_Comission::checkMaxComission('WMZ', 10));
		$this->assertEqual(Webmoney_Comission::checkMaxComission('WMR', 0.01), 0.01);
		$this->assertEqual(Webmoney_Comission::checkMaxComission('WMR', 100), 100);
		$this->assertEqual(Webmoney_Comission::checkMaxComission('WMZ', 100), 50);
		$this->assertEqual(Webmoney_Comission::checkMaxComission('WMR', 2000), 1500);
	}

	function testGetComission() {
		$comm = new Webmoney_Comission();

		$this->assertEqual(Webmoney_Comission::getComission('WMZ', 100), 0.8);
		$this->assertEqual(Webmoney_Comission::getComission('WMR', 1), 0.01);
		$this->assertEqual(Webmoney_Comission::getComission('WMR', 0.1), 0.01);
		$this->assertEqual(Webmoney_Comission::getComission('WMR', 100), 0.8);
		$this->assertEqual(Webmoney_Comission::getComission('WMZ', 10000), 50);
		$this->assertEqual(Webmoney_Comission::getComission('WMR', 200000), 1500);
	}
}

?>
