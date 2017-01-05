<?php
/**
 * ���������� ������ � ���� - ���� �������� ������� ����������� ������
 */
class Algorithm_Main_OperationResult extends Algorithm_Main_State{
	/**
	 *
	 * @var Exchanger_OperationResult
	 */
	private $result;
	/**
	 *
	 * @var Exchanger_ListMyPays_MyPay
	 */
	private $myPay;
	/**
	 *
	 * @var Exchanger_OrderList_Order
	 */
	private $purchasedOrder;

	public function __construct(Exchanger_OperationResult $result, Exchanger_ListMyPays_MyPay $myPay, Exchanger_OrderList_Order $purchasedOrder) {
		$this->result = $result;
		$this->myPay = $myPay;
		$this->purchasedOrder = $purchasedOrder;
	}

	/**
	 * ��������� � ���� ��������� ��������
	 */
	public function run(){
		if ($this->result->getRetval() == Exchanger_OperationResult::SUCCESS) {
			$this->success();
		}
		else {
			$this->fail($result);
		}
	}

	private function success(Exchanger_ListMyPays_MyPay  $myPay, Exchanger_OrderList_Order $purchasedOrder){
		/**
		 * � ���� ����� ����:
		 * 1. wmid+|��� ��������+|id ���� ������+|�� �������� ������|
		 * ����� ���� ������|���� ��������� ������|���� ��|��� %|��� ���.����|���� � ����� ������|
		 */
		$history = new Exchanger_History();
		$history->setMyPay($myPay);
		$history->setPurchasedOrder($purchasedOrder);

		$historyMapper = new ORM_DataMapper_Exchanger_History();
		$historyMapper->save($history);
	}



	private function fail(Exchanger_OperationResult $result){
		$resultMapper = new ORM_DataMapper_Exchanger_OperationResult();
		$error = '������ ������ �� ������� �� �����: ' . $result->getRetdesc();
		$result->setRetdesc($error);
		$resultMapper->save($result);
	}
}