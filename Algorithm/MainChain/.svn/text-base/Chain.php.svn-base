<?php

abstract class Algorithm_MainChain_Chain {
	/**
	 * 
	 * @var Algorithm_MainChain_Chain
	 */
	protected $successor;
	/**
	 * 
	 * @var Algorithm_MainChain_Chain
	 */	
	protected $failer;
	
	/**
	 * 
	 * @param Algorithm_MainChain_Chain $handler
	 * @return Algorithm_MainChain_Chain
	 */	
	public function setSuccessor(Algorithm_MainChain_Chain $handler){
		$this->successor = $handler;
		return $this;
	}
	
	/**
	 * 
	 * @param Algorithm_MainChain_Chain $handler
	 * @return Algorithm_MainChain_Chain
	 */	
	public function setFailer(Algorithm_MainChain_Chain $handler){
		$this->failer = $handler;
		return $this;	
	}
	
	public abstract  function getSuccessor();

	public abstract function getFailer();

}

?>