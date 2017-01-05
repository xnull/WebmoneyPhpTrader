<?php
/**
 * ѕроизводим проверку запущен ли бот по данному направлению,
 * если запущен передаем управление следущему в цепочке.
 * если нет, то выходим.
 */
class Algorithm_MainChain_HandleExchange_Bot extends Algorithm_MainChain_HandleExchange_Chain {
	/**
	 * @param Exchanger_ExchangesList_Exchange Exchanger_ExchangesList_Exchange $exchange
	 */
	public function run(Exchanger_ExchangesList_Exchange $exchange) {
		if (!$this->isRun($exchange)) {
			return;
		}
		//Log_Log::saveToDatabase("—тартует бот по направлению: " . $exchange->getDirection());
		try{
			$this->getSuccessor()->run($exchange);
		}
		catch(Exception $err){
			Log_Log::saveToDatabase("Ќеобрабатываемое исключение : " . $err->getMessage());
		}
	}

	private function isRun(Exchanger_ExchangesList_Exchange $exchange) {
		if ($exchange->getRun () != 'true') {
			return false;
		}
		return true;
	}

}

?>