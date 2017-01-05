<?php
class Algorithm_Main_AlredyPayidMyPayFinder extends Algorithm_Main_State {
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
	
	public function run() {
		//если нет выставленной заявки - проверяю дневной лимит, и если ещё не всё разменяли за сегодня - выставляю новую заявку
		$myPay = $this->findAlredyPayidMyPay ();
		if ($myPay == null) {
			$dayLimitChecker = new Algorithm_Main_DayLimitChecker ( $this->exchange, $this->purchasedOrder );
			$dayLimitChecker->run ();
			return;
		}
		//если есть выставленная моя заявка, то покупаю чужую найденную
		$payer = new Algorithm_Main_Payer ( $myPay, $this->purchasedOrder );
		$payer->run ();
	}
	
	private function findAlredyPayidMyPay() {
		$manager = Application_Registry::getExchangerManager ();
		$wmids = $this->getWmids ();
		
		foreach ( $wmids->getNodeIterator () as $wmid ) {
			try {
				$listMyPays = $manager->getListMyPays ( $wmid, Exchanger_ListMyPays_BidType::PAYED );
				foreach ( $listMyPays->getIterator () as $myPay ) {
					if (Exchanger_Direction::getReverseExchType ( $myPay->getExchType () ) == $this->purchasedOrder->getExchType ()) {
						return $myPay;
					}
				}
			} catch ( Exception $err ) {
				return null;
			}
		}
		return null;
	}
	
	/**
	 *
	 * @return Application_AbstractComposite
	 */
	private function getWmids() {
		return Application_Registry::getConfig ()->getChildNode ( 'WMIDS' );
	}
}