<?php

class Algorithm_Main_Finder extends Algorithm_Main_State {

	public function run() {
		$exchList = $this->getExchList ();

		foreach ( $exchList as $exchange ) {
			if ($exchange->getRun () != 'true') {
				continue;
			}
			if ($this->haveFindedOrder ( $exchange )) {
				$alredyPayidFinder = new Algorithm_Main_AlredyPayidMyPayFinder($exchange,  $exchange->getOrderList()->getFirstOrder());
				$alredyPayidFinder->run();
			}
		}
	}

	/**
	 * ѕолучаем из направлени€ обмена, список за€вок, получаем курс первой за€вки,
	 * и если курс подход€щий, возращаем true иначе false
	 */
	private function haveFindedOrder(Exchanger_ExchangesList_Exchange $exch) {
		try {
			$findedRate = $exch->offRateplusMyPesent ();
			$exchBestRate = $exch->getOrderList ()->getFirstOrder ()->getRate ();

			if (Exchanger_Calculator::largerThanOrEqual ( $exch->getExchType (), $exchBestRate, $findedRate )) {
				return true;
			} else {
				return false;
			}
		} catch ( Exception $err ) {
			return false;			
		}
	}

	/**
	 *
	 * @return Exchanger_ExchangesList_ExchangesList
	 */
	public function getExchList() {
		return Application_Registry::getExchangerManager ()->getExchangesList ();
	}

}
