<?php
class Algorithm_Main_NewPay extends Algorithm_Main_State {
	/**
	 * @var Exchanger_ExchangesList_Exchange
	 */
	private $myExchange;
	/**
	 * @var Webmoney_Purse_Purse
	 */
	private $myPurse;

	public function __construct(Exchanger_ExchangesList_Exchange $myExchange, Webmoney_Purse_Purse $myPurse) {
		$this->myExchange = $myExchange;
		$this->myPurse = $myPurse;
	}

	/**
	 * @return Exchanger_ListMyPays_MyPay
	 */
	public function run() {
		return $this->createNewMyPay ();
	}

	/**
	 * @return Exchanger_ListMyPays_MyPay
	 */
	private function createNewMyPay() {
		$wmid = $this->myPurse->getWmid ()->getWmidComposite ();
		$summForExcange = $this->getSummForExchange ();
		$outpurse = $this->getOutpurse ();
		if ($outpurse == null) {
			return null;
		}

		$myRate = $this->myExchange->offRateplusMyPesent ();
		$outamount = Exchanger_Calculator::multiplication ( $this->myExchange->getExchType (), $summForExcange, $myRate );
		$result = Application_Registry::getExchangerManager ()->newPay ( $wmid, $this->myPurse->getNumber (), $outpurse->getNumber (), $summForExcange, $outamount );
		$myPay = $this->getMyPayFromResult ( $result, $wmid );
		return $myPay;
	}

	/**
	 *
	 * @param Exchanger_OperationResultNewPay $result
	 * @return Exchanger_ListMyPays_MyPay
	 */
	private function getMyPayFromResult(Exchanger_OperationResultNewPay $result, Application_AbstractComposite $wmid) {
		$operationResult = $result->getOperationResult();
		if ($operationResult->getRetval() != Exchanger_OperationResult::SUCCESS) {
			$resultMapper = new ORM_DataMapper_Exchanger_OperationResult ();
			$error = 'Ошибка при создании нового платежа: ' . $operationResult->getRetdesc();
			$operationResult->setRetdesc($error);
			$resultMapper->save ( $operationResult );
			return null;
		}
		$listMyPays = Application_Registry::getExchangerManager ()->getListMyPays ( $wmid, Exchanger_ListMyPays_BidType::PAYED, $result->getOperId () );
		return $listMyPays->getPay ( $result->getOperId () );
	}

	private function getSummForExchange() {
		$summForExchange = $this->myExchange->getMaxSumm ();

		$balance = $this->myPurse->getBalance ();
		$balance = $balance - ($balance * 0.02); //уменьшаем сумму для выставления на бирже, на 2%
		if ($balance < $this->myExchange->getMaxSumm ()) {
			$myBalance = $balance;
			$summForExchange = $myBalance - ($myBalance * 0.02);
		}

		return $summForExchange;
	}

	private function getOutPurse() {
		$outpurse = $this->myPurse->getWmid ()->getPurseByType ( $this->myExchange->getWMDest () );
		if (! isset ( $outpurse )) {
			$log = new Log_Log ();
			$log->setDate ( Log_Log::getNowDate () );
			$log->setMessage ( 'На вмиде: ' . $this->myPurse->getWmid ()->getNumber () . ' нет необходимого кошелька ' . $this->myExchange->getWMDest () . ' для обмена валюты' );
			$logMapper = new ORM_DataMapper_Log_Log ();
			$logMapper->save ( $log );
			return null;
		}
		return $outpurse;
	}
}