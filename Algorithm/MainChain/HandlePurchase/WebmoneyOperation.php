<?php
class Algorithm_MainChain_HandlePurchase_WebmoneyOperation{

	/**
	 * @var Algorithm_MainChain_HandlePurchase_WebmoneyOperation
	 */
	private static $instance;
	private $cashObjects = array();

	/**
	 * @return Algorithm_MainChain_HandlePurchase_WebmoneyOperation
	 */
	private static function getInstance()
	{
		if (empty(self::$instance))
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct(){}

	private function __clone() {}

	/**
	 * @return Webmoney_Interfaces_History_Operation
	 */
	public static function getOperation(Exchanger_ListMyPays_MyPay $myPay){
		$instance = self::getInstance();
		
		$wmtransId = $instance->getWmtransId($myPay);
		if (isset($instance->cashObjects[$wmtransId])) {
			return $instance->cashObjects[$wmtransId];
		}
		
		$wmid = $instance->getWmidComposite($myPay->getWmidNumber());
		$dateStart = Core_DateTime::currDatePlusDay(0);
		//$dateFinish = Core_DateTime::currDatePlusDay(1);
		$dateFinish = Core_DateTime::currDateEndDay();
		$request = new Webmoney_Interfaces_History_Request($wmid, $myPay->getInPurse(), $dateStart, $dateFinish);

		//TODO если транид пустой, то наверное стоит попытаться найти купленную заявку через примечание в платеже
		if ($wmtransId == null) {
			return null;
		}
		$request->setWmtranid($wmtransId);

		$history = new Webmoney_Interfaces_History_History();
		$history->getHistoryFromRequest($request);
		$operation = $history->getOperationsList()->get($history->getOperationsList()->count()-1);
				
		$instance->cashObjects[$operation->getId()] = $operation;
		return $operation;
	}


	private function getWmtransId(Exchanger_ListMyPays_MyPay $myPay){
		$mapper = new ORM_DataMapper_Exchanger_ListMyPays_NewMyPay();
		$newMyPay = $mapper->find($myPay->getId());
		$wmtranid = $newMyPay->getWmtransid();
		return $wmtranid;
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