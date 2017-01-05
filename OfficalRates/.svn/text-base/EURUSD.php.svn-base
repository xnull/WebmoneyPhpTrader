<?php

class OfficalRates_EURUSD extends OfficalRates_OfficalRates  {
	protected $rateType = 'FORWARD';	
	/**
	 * 
	 * @var OfficalRates_OfficalRates
	 */
	private $cbr;
		
	public function __construct(){
		$this->url = 'http://www.cbr.ru/scripts/XML_daily.asp';
		$this->baseCurrencyName = 'EUR';
		
		$this->cbr = Application_Registry::getBank('CBR');
		$this->addEurUsdCurrency();		
	}	
	
	private function addEurUsdCurrency(){
		$currency = new OfficalRates_Currency();
		$currency->setBank($this);
		$currency->setCharCode('EUR');
		$currency->setName('Евро');
		$currency->setNominal(1);
		$currency->setNumCode(978);
		$currency->setRate($this->getEurUsdRate());
		
		$this->getCurrencyList()->addCurrency($currency);
	}
	
	private function getEurUsdRate(){
		$usd = Core_Double::toDouble($this->cbr->getCurrency('USD')->getRate());
		$eur = Core_Double::toDouble($this->cbr->getCurrency('EUR')->getRate());
		
		$rate = $eur/$usd;
		$rate = Core_Double::trimToThreeCipher($rate);
		return $rate;
	}
}

?>