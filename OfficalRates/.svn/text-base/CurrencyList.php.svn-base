<?php
class OfficalRates_CurrencyList extends Core_Collections_HashMap {
	
	/**
	 * 
	 * @param str $charCode имя валюты (usd Например)
	 * @return OfficalRates_Currency
	 */
	public function getCurrency($charCode){		
		return $this->getValue($charCode);
	}
	
	public function addCurrency(OfficalRates_Currency $currency){
		$this->add($currency->getCharCode(), $currency);
	}
	
	public function clearList(){
		$this->clear();
	}
}

?>