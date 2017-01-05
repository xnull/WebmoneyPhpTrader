<?php

abstract class Algorithm_MainChain_HandleExchange_Chain extends Algorithm_MainChain_Chain {
	public abstract function run(Exchanger_ExchangesList_Exchange $exchange);
	
	/**
	 * @return Algorithm_MainChain_HandleExchange_Chain
	 */
	public function getFailer() {
		return $this->failer;
	}
	
	/**
	 * @return Algorithm_MainChain_HandleExchange_Chain
	 */
	public function getSuccessor() {
		return $this->successor;
	}
}

?>