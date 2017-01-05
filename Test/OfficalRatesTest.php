<?php

include_once '__TestGlobals.php';

class OfficalRatesTest extends UnitTestCase {
	function CBRTest() {
		$this->UnitTestCase();
	}
	
	public function testOffRatesFactory(){
		$factory = new OfficalRates_OfficalRatesFactory();
		$factory->refreshOfficalRatesCash();
		$eurusd = $factory->getEURUSD();
		$euCurrency = $eurusd->getCurrency('EUR');
		
		$this->assertEqual($euCurrency->getCharCode(), 'EUR');
		$this->assertEqual($euCurrency->getRate(), 1.282);
	}

	public function testGetCBRRate() {		
		$offFactory = new OfficalRates_OfficalRatesFactory();
		$CBR = $offFactory->getCBR();
		
		$this->assertEqual($CBR->getBaseCurrencyName(), "RUB" );
		$this->assertEqual($CBR->getCurrency("USD")->getCharCode(), "USD");
		$this->assertEqual($CBR->getCurrency("USD")->getNumCode(), "840");
		$this->assertEqual($CBR->getCurrency("USD")->getNominal(), "1");
		$this->assertEqual($CBR->getCurrency("USD")->getRate(), "30,4636", $CBR->getCurrency("USD")->getRate());
		$this->assertEqual($CBR->getCurrencyList()->count(), "36", $CBR->getCurrencyList()->count());		
	}

	
	public function TestGetNBURate() {
		$offFactory = new OfficalRates_OfficalRatesFactory();
		$NBU = $offFactory->getNBU();
		
		$this->assertEqual($NBU->getBaseCurrencyName(), "UAH" );
		$this->assertEqual($NBU->getCurrency("USD")->getCharCode(), "USD");
		$this->assertEqual($NBU->getCurrency("USD")->getNumCode(), "840");
		$this->assertEqual($NBU->getCurrency("USD")->getNominal(), "100");
		$this->assertEqual($NBU->getCurrency("USD")->getRate(), "789.0300", $NBU->getCurrency("USD")->getRate());
		$this->assertEqual($NBU->getCurrencyList()->count(), "28", $NBU->getCurrencyList()->count());
	}	
}
?>
