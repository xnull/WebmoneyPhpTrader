<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}

class ExchangeTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testList() {
		$wmz_wmr_conf = Application_Registry::getConfig()->getChildNode("Exchanges")->getChildNode('WMZ_WMR');
		$wmz_wmr = new Exchanger_ExchangesList_Exchange($wmz_wmr_conf);
				
		$this->assertEqual($wmz_wmr->getRealCurrencyName(), "USD");
		$this->assertEqual($wmz_wmr->getWMSurce(), "WMZ");
		$this->assertEqual($wmz_wmr->getWMDest(), "WMR");
		$this->assertEqual($wmz_wmr->getExchType(), "1");		
		//$this->assertEqual($wmz_wmr->getBank()->getBaseCurrencyName(), "RUB");
		//$this->assertEqual($wmz_wmr->getBank()->getCurrency("USD")->getNumCode(), "840");
	}
	
	
}

?>
