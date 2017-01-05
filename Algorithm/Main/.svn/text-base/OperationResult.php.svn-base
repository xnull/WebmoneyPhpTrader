<?php
/**
 * Сохранение данных в базу - если операция покупки завершилась удачно
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
	 * Сохраняем в базу результат операции
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
		 * В базе будут поля:
		 * 1. wmid+|мой кошельек+|id моей заявки+|ид купленой заявки|
		 * сумма моей заявки|курс купленной заявки|курс цб|мой %|мой пол.курс|дата и время обмена|
		 */
		$history = new Exchanger_History();
		$history->setMyPay($myPay);
		$history->setPurchasedOrder($purchasedOrder);

		$historyMapper = new ORM_DataMapper_Exchanger_History();
		$historyMapper->save($history);
	}



	private function fail(Exchanger_OperationResult $result){
		$resultMapper = new ORM_DataMapper_Exchanger_OperationResult();
		$error = 'Ошибка заявка не куплена на бирже: ' . $result->getRetdesc();
		$result->setRetdesc($error);
		$resultMapper->save($result);
	}
}