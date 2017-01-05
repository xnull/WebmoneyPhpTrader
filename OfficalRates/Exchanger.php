<?php
class OfficalRates_Exchanger extends OfficalRates_OfficalRates{
	private $exchType;	

	public function __construct(){
		$this->url = 'https://wm.exchanger.ru/asp/XMLWMList.asp';		
	}
	
	public function getUrl(){
		if ($this->exchType == null){
			$this->url . "?exchtype=1";
		}
		return $this->url . "?exchtype=" . $this->exchType;
	}

	/**
	 * 
	 * @param unknown_type $direction
	 * @return OfficalRates_Currency
	 */
	public function getCurrency($direction){
		//по коду направления коннектимся к эксченджеру, и выбираем
		$exchList = Application_Registry::getExchangerManager()->getExchangesList();
		$exchtype = $exchList->getExchTypeFromDirection($direction);
		$this->exchType = $exchtype;
		
		$rate = $exchList->getExchange($direction)->getOrderList()->getOfficalRateInExchanger();
		$this->addCurrencyByCharCode($direction, $rate);
		return $this->getCurrencyList()->getCurrency($direction);
		//return $this->currencyList->getCurrency($charCode);
	}

	/**
	 * 
	 * @param unknown_type $direction
	 * @param unknown_type $rate
	 * @return OfficalRates_Currency
	 */
	private function addCurrencyByCharCode($direction, $rate){
		$currency = new OfficalRates_Currency();
		$currency->setBank($this);
		$currency->setCharCode($direction);		
		$currency->setNominal(1);		
		$currency->setRate($rate);

		$this->getCurrencyList()->addCurrency($currency);
	}
}