<?php

class Algorithm_MainChain_Algorithm {
	
	public function start() {
		$this->handleAllExchanges ();
	}
	
	/**
	 * Обрабатываем все направления обменов, для поиска и покупки необходимых заявок
	 */
	private function handleAllExchanges() {
		foreach ( $this->getExchList () as $exchange ) {
			$bot = $this->init();
			$bot->run ( $exchange );
		}
	}
	
	private function init(){
		$bot = new Algorithm_MainChain_HandleExchange_Bot ();
		$orderFinder = new Algorithm_MainChain_HandleExchange_OrderFinder ();
		$myPayFinder = new Algorithm_MainChain_HandleExchange_MyPayFinder();
		$dayLimitChecker = new Algorithm_MainChain_HandleExchange_DayLimitChecker();
		$customer = new Algorithm_MainChain_HandlePurchase_Customer();
		$myPayCreater = new Algorithm_MainChain_HandleExchange_MyPayCreater();		
		$successOperation = new Algorithm_MainChain_HandlePurchase_SuccessOperation();
		$dayRemains = new Algorithm_MainChain_HandlePurchase_DayRemains();
		
		/**
		 * Создаем бота, для проверки запущен ли он по данному напрвлению.
		 * Если запущен - передаем управление поиску подходящих для скупки, заявок с биржи
		 */
		$bot->setSuccessor($orderFinder);

		/**
		 * Ищем по анправлению лучшие заявки, если курс подходит для скупки, 
		 * передаем управление - поиску моей выставленной заявки на бирже
		 */
		$orderFinder->setSuccessor($myPayFinder);

		/**
		 * купить заявку.
		 * Ищем мою уже выставленную заявку.
		 * Если выставленных подходящих заявок нет, то передаем управление проверятелю дневного лимита
		 */
		$myPayFinder->setSuccessor($customer)->setFailer($dayLimitChecker);
		$dayLimitChecker->setSuccessor($myPayCreater);
		$myPayCreater->setSuccessor($myPayFinder);			
		
		/**
		* Покупаем заявку с биржи, и передаем данные для сохранения в базу, или для записи в лог - о неудачной операции
		*/
		$customer->setSuccessor($successOperation);//->setFailer();
		$successOperation->setSuccessor($dayRemains);
		
		return $bot;
	}
		
	/**
	 *
	 * @return Exchanger_ExchangesList_ExchangesList
	 */
	public function getExchList() {
		return Application_Registry::getExchangerManager ()->getExchangesList ();
	}
}

?>