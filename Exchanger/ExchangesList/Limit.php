<?php
class Exchanger_ExchangesList_Limit extends Application_DomainObject{
	private $exchType;
	private $dayLimit;
	private $remains;
	private $date;

	public function setDate($date){
		$this->date = Core_DateTime::toDateTime($date);
	}

	public function getDate(){
		return Core_DateTime::toDateTime($this->date);
	}

	public function getExchType(){
		return $this->exchType;
	}

	public function getDayLimitFromConfig($exchType){
		$manager = Application_Registry::getExchangerManager();
		$exchList = new Exchanger_ExchangesList_ExchangesList ();
		$exch = $exchList->getExchangeByExchType($exchType);
		return $exch->getDayLimit();
	}

	public function getRemains(){
		return $this->remains;
	}

	public function setRemains($remains){
		$this->remains = $remains;
	}

	public function setDayLimit($limit){
		$this->dayLimit = $limit;
	}

	public function setExchType($exchType){
		$this->exchType = $exchType;
	}
}
