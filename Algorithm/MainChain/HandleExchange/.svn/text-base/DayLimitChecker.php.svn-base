<?php
/**
 * ѕровер€ем исчерпали ли мы на сегодн€ лимит дл€ обмена по данному направлению.
 * ≈сли нет, то передаем управление дальше
 */
class Algorithm_MainChain_HandleExchange_DayLimitChecker extends Algorithm_MainChain_HandleExchange_Chain{

	public function run(Exchanger_ExchangesList_Exchange $exchange){
		if ($this->dayLimitIsOver($exchange)) {
			Log_Log::saveToDatabase("Ћимит на сегодн€ по этому направлению исчеран: " . $exchange->getDirection() . " останавливаем работу по этому направлению" );
			return false;
		}
		$this->getSuccessor()->run($exchange);		
	}

	private function dayLimitIsOver(Exchanger_ExchangesList_Exchange $exchange){
		$myExchange = $this->getMyExchange($exchange);
		$dayLimit = $this->getDayLimit($myExchange);
			
		if ($dayLimit->getRemains () < $myExchange->getMinSumm ()) {
			return true;
		}
		return false;
	}

	/**
	 * @return Exchanger_ExchangesList_limit
	 */
	private function getDayLimit(Exchanger_ExchangesList_Exchange $myExchange) {		
		$limitMapper = new ORM_DataMapper_Exchanger_ExchangesList_Limit ();
		return $limitMapper->find ( $myExchange->getExchType () );
	}

	/**
	 *
	 * @return Exchanger_ExchangesList_Exchange
	 */
	private function getMyExchange(Exchanger_ExchangesList_Exchange $exchange) {
		$exchangesList = $this->getExchangesList();
		$myExchType = Exchanger_Direction::getReverseExchType ($exchange->getExchType());
		$myExchange = $exchangesList->getExchangeByExchType ( $myExchType );
		return $myExchange;
	}
	/**
	 *
	 * @return Exchanger_ExchangesList_ExchangesList
	 */
	private function getExchangesList(){
		$exchManager = Application_Registry::getExchangerManager ();
		$exchangesList = $exchManager->getExchangesList ();
		return $exchangesList;
	}
}