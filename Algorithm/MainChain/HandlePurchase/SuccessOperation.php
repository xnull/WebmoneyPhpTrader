<?php
class Algorithm_MainChain_HandlePurchase_SuccessOperation extends Algorithm_MainChain_HandlePurchase_Chain {
	/**
	 * @param Exchanger_ExchangesList_Exchange $exchange
	 * @param Exchanger_ListMyPays_MyPay $myPay
	 */
	public function run(Exchanger_ExchangesList_Exchange $exchange, Exchanger_ListMyPays_MyPay $myPay) {
		/**
		 * В базе будут поля:
		 * 1. wmid+|мой кошельек+|id моей заявки+|ид купленой заявки|
		 * сумма моей заявки|курс купленной заявки|курс цб|мой %|мой пол.курс|дата и время обмена|
		 */
		$history = new Exchanger_History ();
		$history->setMyPay ( $myPay );
		$history->setPurchasedOrder($exchange->getFirstOrder());

		$history->setCbRate($exchange->getOfficalRate());
		$history->setMyPersent($exchange->getMyPersent());
		
		//$operation = Algorithm_MainChain_HandlePurchase_WebmoneyOperation::getOperation($myPay);
		//$history->setPurseSumm($operation->getAmount());
		$history->setPurseSumm($myPay->getAmountOut());

		$historyMapper = new ORM_DataMapper_Exchanger_History ();
		$historyMapper->save ( $history );

		$this->getSuccessor()->run($exchange, $myPay);
	}

	
	
	
}