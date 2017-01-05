<?php
class Algorithm_MainChain_HandlePurchase_DayRemains extends Algorithm_MainChain_HandlePurchase_Chain{

	public function run(Exchanger_ExchangesList_Exchange $exchange, Exchanger_ListMyPays_MyPay $myPay){
		$this->setRemains($myPay);
	}

	private function setRemains(Exchanger_ListMyPays_MyPay $myPay) {
		$limitMapper = new ORM_DataMapper_Exchanger_ExchangesList_Limit ();
		$limit = $limitMapper->find ( $myPay->getExchType () );
		$operation = Algorithm_MainChain_HandlePurchase_WebmoneyOperation::getOperation($myPay);
		if ($operation != null) {
			$limit->setRemains ( $limit->getRemains () - $operation->getAmount() );
			$limitMapper->update( $limit );
		}
		else{
			Log_Log::saveToDatabase("Не смог получить из истории кошелька, переведенную сумму. Взял сумму с заявки. Направление: " . $myPay->getDirection());
			$limit->setRemains ( $limit->getRemains () - $myPay->getSumm() );
			$limitMapper->update( $limit );
		}
	}

}