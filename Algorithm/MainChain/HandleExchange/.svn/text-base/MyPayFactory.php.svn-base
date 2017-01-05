<?php

class Algorithm_MainChain_HandleExchange_MyPayFactory {

	public function createMyPay(Exchanger_ExchangesList_Exchange $exchange, Webmoney_WMID_WMID $wmid) {
		$myPay = $this->createNewMyPay ($exchange, $wmid);
		return $myPay;
	}

	/**
	 * @return Exchanger_ListMyPays_MyPay
	 */
	private function createNewMyPay(Exchanger_ExchangesList_Exchange $exchange, Webmoney_WMID_WMID $wmid) {
		$myExchange = $this->getMyExchange ( $exchange );
		$purse = $this->tryGetPurseForPurchase ( $myExchange, $wmid );
		if ($purse == null) {
			Log_Log::saveToDatabase("Не смог создать мою заявку, у меня на вмиде: " . $wmid->getNumber() . " нет необходимого кошелька. Монитор направления: " . $exchange->getDirection());
			return null;
		}

		$summForExchange = $this->getSummForExchange ( $myExchange, $purse );
		$outpurse = $this->getOutpurse ($myExchange, $wmid);
		if ($outpurse == null) {
			Log_Log::saveToDatabase("Не смог создать мою заявку, у меня на вмиде: " . $wmid->getNumber() . " нет необходимого кошелька приемника. Монитор направления: " . $exchange->getDirection());
			return null;
		}

		
		//$myRate = $myExchange->offRateplusMyPesent ();
		$myRate = Core_Double::toDouble($this->getSorokovoiOrder($myExchange)->getRate());
		
		$outamount = Exchanger_Calculator::multiplication ( $myExchange->getExchType (), $summForExchange, $myRate );
		$result = Application_Registry::getExchangerManager ()->newPay ( $wmid->getWmidComposite (), $purse->getNumber (), $outpurse->getNumber (), $summForExchange, $outamount );
		if ($result->getOperId() == null) {
			Log_Log::saveToDatabase("Не удалось поставить свою заявку на биржу. Ошибка: " . $result->getOperationResult()->getRetval() . "/" . $result->getOperationResult()->getRetdesc() . " Направление: " . $exchange->getDirection());
			return null;
		}

		$this->saveNewMyPayToDB($result);
		$myPay = $this->getMyPayFromResult ( $result, $wmid->getWmidComposite () );
		return $myPay;
	}
	
	/**
	 * @param Exchanger_ExchangesList_Exchange $myExchange
	 * @return Exchanger_OrderList_Order
	 */
	private function getSorokovoiOrder(Exchanger_ExchangesList_Exchange $myExchange){
		$i=0;
		$orderList = $myExchange->getOrderList();
		foreach ($orderList->getIterator() as $order) {			
			$i = $i+1;
			if ($i >= $orderList->count()){
				return $order;
			}
			if ($i == 40){
				return $order;
			}
		}
		return $orderList->getFirstOrder();
	}

	private function saveNewMyPayToDB(Exchanger_OperationResultNewPay $newPay){
		$mapper = new ORM_DataMapper_Exchanger_ListMyPays_NewMyPay();
		$mapper->save($newPay);
	}

	/*
	 * @param Exchanger_ExchangesList_Exchange $exchange
	 * @param Webmoney_WMID_WMID $wmid
	 * @return Webmoney_Purse_Purse
	 */
	private function tryGetPurseForPurchase(Exchanger_ExchangesList_Exchange $myExchange, Webmoney_WMID_WMID $wmid) {
		$purse = $wmid->getPurseByType ( $myExchange->getWMSurce () );
		if ($purse == null) {
			return null;
		}

		//если на кошельке меньше минимальной суммы, то Значит кошелек не подходит
		if ($purse->getBalance () < $myExchange->getMinSumm ()) {
			return null;
		}

		return $purse;
	}

	private function getSummForExchange(Exchanger_ExchangesList_Exchange $myExchange, Webmoney_Purse_Purse $myPurse) {
		$rand = Core_Double::toDouble(rand(1, 10)/100);
		$summForExchange = Core_Double::toDouble($myExchange->getMaxSumm()) - $rand;

		$balance = Core_Double::toDouble($myPurse->getBalance ());
		$balance = Core_Double::toDouble($balance) - Core_Double::toDouble(($balance * 0.02)); //уменьшаем сумму для выставления на бирже, на 2%
		if ($balance < $summForExchange) {
			$myBalance = $balance;
			$summForExchange = Core_Double::toDouble($myBalance) - Core_Double::toDouble($myBalance * 0.02);
		}

		return $summForExchange;
	}

	private function getOutPurse(Exchanger_ExchangesList_Exchange $myExchange, Webmoney_WMID_WMID $wmid) {
		$outpurse = $wmid->getPurseByType ( $myExchange->getWMDest());
		if ($outpurse == null) {
			$log = new Log_Log ();
			$log->setDate ( Log_Log::getNowDate () );
			$log->setMessage ( 'На вмиде: ' . $wmid->getNumber() . ' нет кошелька:' . $myExchange->getWMDest() . ' для обмена валюты' );
			$logMapper = new ORM_DataMapper_Log_Log ();
			$logMapper->save ( $log );
		}
		return $outpurse;
	}

	/**
	 *
	 * @param Exchanger_OperationResultNewPay $result
	 * @return Exchanger_ListMyPays_MyPay
	 */
	private function getMyPayFromResult(Exchanger_OperationResultNewPay $result, Application_AbstractComposite $wmid) {
		if ($result == null) {
			return null;
		}
		$operationResult = $result->getOperationResult();
		if ($operationResult->getRetval () != Exchanger_OperationResult::SUCCESS) {
			$resultMapper = new ORM_DataMapper_Exchanger_OperationResult ();
			$error = 'MyPayFactory, ошибка при создании нового платежа: ' . $operationResult->getRetdesc();
			$operationResult->setRetdesc($error);
			$resultMapper->save ( $operationResult );
			return null;
		}
		$listMyPays = Application_Registry::getExchangerManager ()->getListMyPays ( $wmid, Exchanger_ListMyPays_BidType::PAYED, $result->getOperId () );
		return $listMyPays->getPay ( $result->getOperId () );
	}

	/**
	 *
	 * @return Exchanger_ExchangesList_Exchange
	 */
	private function getMyExchange(Exchanger_ExchangesList_Exchange $exchange) {
		$exchangesList = Application_Registry::getExchangerManager ()->getExchangesList ();
		$myExchange = $exchangesList->getExchangeByExchType ( $exchange->getReverseExchType () );
		return $myExchange;
	}

}

?>