<?php
class Algorithm_Main_Payer extends Algorithm_Main_State{
	/**
	 * @var Exchanger_OrderList_Order
	 */
	private $purchasedOrder;
	/**
	 *
	 * @var Exchanger_ListMyPays_MyPay
	 */
	private $myPay;

	public function __construct(Exchanger_ListMyPays_MyPay $myPay, Exchanger_OrderList_Order  $purchasedOrder){
		$this->purchasedOrder = $purchasedOrder;
		$this->myPay = $myPay;
	}

	public function run(){
		$manager = Application_Registry::getExchangerManager();		
		$wmid = $this->getWmidComposite($this->myPay->getWmidNumber());
		$result = $manager->sale($wmid, $this->myPay->getId(), $this->purchasedOrder->getId());
		
		if ($result->getRetval() == Exchanger_OperationResult::SUCCESS) {
			$this->setRemains();
		}

		$operationResultState = new Algorithm_Main_OperationResult($result, $this->myPay, $this->purchasedOrder);
		$operationResultState->run();
	}

	private function setRemains(){
		$limitMapper = new ORM_DataMapper_Exchanger_ExchangesList_Limit();
		$limit = $limitMapper->find($this->myPay->getExchType());
		//для вычисления - сколько куплено - нужно взять баланс старого моего платежа, и баланс нового и отнять
		$newMyPay = $this->getNewMyPay($this->myPay->getId());
		$exchSumm = $newMyPay->getSumm() - $this->myPay->getSumm();
		$limit->setRemains($limit->getRemains() - $exchSumm);
		$limitMapper->save($limit);
	}
	
	/**
	 * 
	 * @param unknown_type $id
	 * @return Exchanger_ListMyPays_MyPay
	 */
	private function getNewMyPay($myPayId){
		$manager = Application_Registry::getExchangerManager();
		$wmid = $this->getWmidComposite($this->myPay->getWmidNumber());
		return $manager->getListMyPays($wmid, Exchanger_ListMyPays_BidType::ALLTYPES, $myPayId);		
	}

	/**
	 * 
	 * @param unknown_type $wmidNumber
	 * @return Application_Composite
	 */
	private function getWmidComposite($wmidNumber){
		$wmidFactory = new Webmoney_WMID_WMIDFactory();
		return $wmidFactory->getWmidList()->getWmidByNumber($wmidNumber)->getWmidComposite();		
	}
}