<?php
/**
 * —оздает (выставл€ет) мой новый платеж на бирже.
 * аналог MyPurseFinder
 */
class Algorithm_MainChain_HandleExchange_MyPayCreater extends Algorithm_MainChain_HandleExchange_Chain {

	public function run(Exchanger_ExchangesList_Exchange $exchange) {
		$mypay = $this->createMyPay ( $exchange );
		if ($mypay == null) {
			Log_Log::saveToDatabase("Ќе удалось создать свою за€вку, монитор напралени€: " . $exchange->getDirection());
			return null;
		}
		
		$this->getSuccessor()->run($exchange);
	}

	/**
	 * @return Exchanger_ListMyPays_MyPay
	 */
	private function createMyPay(Exchanger_ExchangesList_Exchange $exchange) {
		$wmidList = $this->getWmidList ();
		$myPayFactory = new Algorithm_MainChain_HandleExchange_MyPayFactory();
		foreach ( $wmidList->iterator () as $wmid ) {
			$myPay = $myPayFactory->createMyPay( $exchange, $wmid );
			if ($myPay == null) {
				continue;
			}
			return $myPay;
		}
	}

	/**
	 *
	 * @return Webmoney_WMID_WMIDList
	 */
	private function getWmidList() {
		$wmidFactory = new Webmoney_WMID_WMIDFactory ();
		return $wmidFactory->getWmidList ();
	}	
}