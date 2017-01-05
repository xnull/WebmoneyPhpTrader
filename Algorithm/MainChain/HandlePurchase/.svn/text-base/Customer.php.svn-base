<?php
/**
 * »щем мою выставленную за€вку на бирже, и покупаем за€вку (јналог MyPurseFinder)
 */
class Algorithm_MainChain_HandlePurchase_Customer extends Algorithm_MainChain_HandlePurchase_Chain {

	public function run(Exchanger_ExchangesList_Exchange $exchange, Exchanger_ListMyPays_MyPay $myPay) {
		$result = $this->payOrder ( $myPay, $exchange );

		if ($result->getRetval () == Exchanger_OperationResult::SUCCESS) {
			$this->getSuccessor ()->run ( $exchange, $myPay );
		} else {
			//пишем в базу о неуспешной операции
			$resultMapper = new ORM_DataMapper_Exchanger_OperationResult ();
			//$result->setRetdesc(iconv('UTF-8', 'windows-1251', $result->getRetdesc()) );
			$error = 'ќщибка при покупке ордера с биржи: ' . $result->getRetdesc();
			$result->setRetdesc($error);
			$resultMapper->save ( $result );
		}
	}

	/**
	 *
	 * @param Exchanger_ListMyPays_MyPay $myPay
	 * @param Exchanger_ExchangesList_Exchange $exchange
	 * @return Exchanger_OperationResult
	 */
	private function payOrder(Exchanger_ListMyPays_MyPay $myPay, Exchanger_ExchangesList_Exchange $exchange) {
		$wmid = $this->getWmidComposite ( $myPay->getWmidNumber () );
		$manager = $this->getExchangerManager ();
		$result = $manager->sale ( $wmid, $myPay->getId (), $exchange->getFirstOrder ()->getId () );
		return $result;
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
	 * @param unknown_type $wmidNumber
	 * @return Application_Composite
	 */
	private function getWmidComposite($wmidNumber) {
		$wmidFactory = new Webmoney_WMID_WMIDFactory ();
		return $wmidFactory->getWmidList ()->getWmidByNumber ( $wmidNumber )->getWmidComposite ();
	}
}