<?php
class Algorithm_Main_MyPurseFinder extends Algorithm_Main_State {

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

	public function __construct(Exchanger_ExchangesList_Exchange $exchange) {
		$this->exchange = $exchange;
		$this->purchasedOrder = $exchange->getOrderList ()->getFirstOrder ();
	}

	public function run(){
		$myPay = $this->createNewPayForPurchaseOrder();
		if ($myPay == null) {
			return;
		}
		
		$payer = new Algorithm_Main_Payer($myPay, $this->purchasedOrder);
		$payer->run();
	}

	/**
	 * @return Exchanger_ListMyPays_MyPay
	 */
	private function createNewPayForPurchaseOrder() {
		$wmidFactory = new Webmoney_WMID_WMIDFactory ();
		$wmidList = $wmidFactory->getWmidList ();

		foreach ( $wmidList->iterator () as $wmid ) {
			$purse = $this->tryGetPurseFromWmid($wmid);
			if (!isset($purse)) {
				continue;
			}
				
			$myPay = $this->tryCreateNewMyPay($purse);
			if ($myPay == null) {
				continue;
			}
			return $myPay;
		}
	}

	/**
	 *
	 * @param Webmoney_WMID_WMID $wmid
	 * @return Exchanger_ListMyPays_MyPay
	 */
	private function tryCreateNewMyPay(Webmoney_Purse_Purse $purse) {
		$myNewPay = new Algorithm_Main_NewPay ($this->getMyExchange(), $purse);
		$myPay = $myNewPay->run ();
		return $myPay;
	}

	private function tryGetPurseFromWmid(Webmoney_WMID_WMID $wmid){
		$myExchange = $this->getMyExchange ();
		$purse = $wmid->getPurseByType ( $myExchange->getWMSurce () );
		if ($purse == null) {
			return null;
		}
		
		//если на кошельке меньше минимальной суммы, то идем дальше
		if ($purse->getBalance () < $myExchange->getMinSumm ()) {
			return null;
		}

		return $purse;
	}

	/**
	 *
	 * @return Exchanger_ExchangesList_Exchange
	 */
	private function getMyExchange() {
		$exchManager = Application_Registry::getExchangerManager ();
		$exchangesList = $exchManager->getExchangesList ();
		$myExchType = Exchanger_Direction::getReverseExchType ( $this->exchange->getExchType () );
		$myExchange = $exchangesList->getExchangeByExchType ( $myExchType );
		return $myExchange;
	}
}