<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}

class OffRatesTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	public function testNBRB() {
		$fact = new OfficalRates_OfficalRatesFactory();
		//$cbr = $fact->getCBR();
		$exchanger = $fact->getExchanger();
		$this->assertEqual($exchanger->getCurrency("WMZ_WMR")->getRate(), "30,6831");
		//$this->assertEqual($cbr->getCurrency('USD')->getNumCode(), "840");
	}
}

?>
