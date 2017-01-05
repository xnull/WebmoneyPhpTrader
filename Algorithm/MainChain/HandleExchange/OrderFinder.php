<?php

/**
 * Проверяем, если лучшая (первая) заявка на бирже, подходит для покупки,
 * передаем управление следующему в цепочке
 */
class Algorithm_MainChain_HandleExchange_OrderFinder extends Algorithm_MainChain_HandleExchange_Chain {

	public function run(Exchanger_ExchangesList_Exchange $exchange) {
		if ($this->haveFindedOrder ( $exchange )) {
			$this->getSuccessor ()->run ( $exchange );
		}
	}

	/**
	 * Получаем из направления обмена, список заявок, получаем курс первой заявки,
	 * и если курс подходящий, возращаем true иначе false
	 */
	private function haveFindedOrder(Exchanger_ExchangesList_Exchange $exch) {
		try {
			$findedRate = $exch->offRateplusMyPesent ();
			$exchBestRate = $exch->getFirstOrder()->getRate();
				
			if (Exchanger_Calculator::largerThanOrEqual ( $exch->getExchType (), $findedRate, $exchBestRate )) {
				Log_Log::saveToDatabase("Нашли подходящую заявку на бирже. Искомый курс: " . $findedRate . " курс заявки с биржы: " . $exchBestRate . " Направление обмена: " . $exch->getDirection());
				return true;
			}
			else {
				return false;
			}
		} catch ( Exception $err ) {
			return false;
		}
	}
}
?>