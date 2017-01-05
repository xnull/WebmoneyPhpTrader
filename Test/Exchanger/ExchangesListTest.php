<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}

class ExchangesListTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testList() {
		$exchList = new Exchanger_ExchangesList_ExchangesList();
		$wmz_wmr = $exchList->getExchange("WMZ_WMR");
		
		$this->assertEqual($wmz_wmr->getRealCurrencyName(), "USD");
		$this->assertEqual($wmz_wmr->getWMSurce(), "WMZ");
		$this->assertEqual($wmz_wmr->getWMDest(), "WMR");
		$this->assertEqual($wmz_wmr->getExchType(), "1");
		//$this->assertEqual($wmz_wmr->getBank()->getBaseCurrencyName(), "RUB");
		//$this->assertEqual($wmz_wmr->getBank()->getCurrency("USD")->getNumCode(), "840");
	}
	
	
}

?>
