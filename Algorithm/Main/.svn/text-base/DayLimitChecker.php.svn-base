<?php
class Algorithm_Main_DayLimitChecker extends Algorithm_Main_State {
	/**
	 *
	 * @var Exchanger_OrderList_Order
	 */
	private $purchasedOrder;
	/**
	 *
	 * @var Exchanger_ExchangesList_Exchange
	 */
	private $exchange;

	public function __construct(Exchanger_ExchangesList_Exchange $exchange, Exchanger_OrderList_Order $purchasedOrder) {
		$this->exchange = $exchange;
		$this->purchasedOrder = $purchasedOrder;
	}

	public function run(){
		if ($this->dayLimitIsOver()) {
			return false;
		}
		$myPurseFinder = new Algorithm_Main_MyPurseFinder($this->exchange, $this->purchasedOrder);
		$myPurseFinder->run();
	}

	/**
	 * @return Exchanger_ExchangesList_limit
	 */
	private function getDayLimit() {
		$myExchange = $this->getMyExchange ();
		$limitMapper = new ORM_DataMapper_Exchanger_ExchangesList_Limit ();
		return $limitMapper->find ( $myExchange->getExchType () );
	}

	private function dayLimitIsOver(){
		$dayLimit = $this->getDayLimit ();
		$myExchange = $this->getMyExchange ();
		if ($dayLimit->getRemains () < $myExchange->getMinSumm ()) {
			return true;
		}
		return false;
	}

	/**
	 *
	 * @return Exchanger_ExchangesList_Exchange
	 */
	private function getMyExchange() {
		$exchManager = Application_Registry::getExchangerManager ();
		$exchangesList = $exchManager->getExchangesList ();
		$myExchType = Exchanger_Direction::getReverseExchType ( $this->exchange->getExchType());
		$myExchange = $exchangesList->getExchangeByExchType ( $myExchType );
		return $myExchange;
	}
}