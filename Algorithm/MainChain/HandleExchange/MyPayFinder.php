<?php

/**
 * »щем уже выставленные мои за€вки на бирже, и среди них выбираем мою подход€щую
 */
class Algorithm_MainChain_HandleExchange_MyPayFinder extends Algorithm_MainChain_HandleExchange_Chain{

	public function run(Exchanger_ExchangesList_Exchange $exchange){
		$myPay = $this->findMyPay($exchange);
		if ($myPay == null) {
			$this->getFailer()->run($exchange);
			return;
		}
		$this->getHandlePurchaseSuccessor()->run($exchange, $myPay);
	}

	/**
	 * @return Algorithm_MainChain_HandlePurchase_Chain
	 */
	private function getHandlePurchaseSuccessor(){
		return $this->getSuccessor();
	}
	/**
	 * @return Exchanger_ListMyPays_MyPay
	 */
	public function findMyPay(Exchanger_ExchangesList_Exchange $exchange) {
		$wmidList = $this->getWmids ();

		foreach ( $wmidList->iterator() as $wmid ) {
			$myPay = $this->findMyPayInExchanger($exchange, $wmid);
			if ($myPay == null) {
				continue;
			}
			return $myPay;
		}
		return null;
	}



	/**
	 *
	 * @param Application_AbstractComposite $wmid
	 * @return Exchanger_ListMyPays_MyPay
	 */
	private function findMyPayInExchanger(Exchanger_ExchangesList_Exchange $exchange, Webmoney_WMID_WMID $wmid) {
		$manager = $this->getExchangerManager ();
		try {
			$listMyPays = $manager->getListMyPays($wmid->getWmidComposite(), Exchanger_ListMyPays_BidType::PAYED );
			foreach ( $listMyPays->getIterator () as $myPay ) {				
				if ($myPay->getReverseExchType() == $exchange->getFirstOrder()->getExchType ()) {
					return $myPay;
				}
			}
		} catch ( Exception $err ) {
			return null;
		}
		return null;
	}

	/**
	 *
	 * @return Exchanger_Manager
	 */
	private function getExchangerManager() {
		return Application_Registry::getExchangerManager ();
	}

	/**
	 *
	 * @return Webmoney_WMID_WMIDList
	 */
	private function getWmids() {
		$wmids = new Webmoney_WMID_WMIDFactory();
		return $wmids->getWmidList();
		//return Application_Registry::getConfig ()->getChildNode ( 'WMIDS' );
	}

}

?>