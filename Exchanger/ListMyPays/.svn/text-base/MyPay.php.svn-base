<?php

/**
 * Моя заявка на бирже
 */
class Exchanger_ListMyPays_MyPay extends Exchanger_Pay {
	/**
	 *
	 * @var Exchanger_ListMyPays_ListMyPays
	 */
	protected $listMyPays;
	private $wmidNUmber;
	/**
	 * Получить описание статуса заявки.
	 * @see Exchanger/Exchanger_Pay#getStateDescription()
	 */
	public function getStateDescription(){
		return Exchanger_ListMyPays_PayState::getStateDescription($this->state);
	}

	public function getListMyPays(){
		return $this->listMyPays;
	}

	public function setListMyPays(Exchanger_ListMyPays_ListMyPays $listMyPays){
		$this->listMyPays = $listMyPays;
	}

	public function getWmidNumber(){
		return $this->wmidNUmber;
	}
	
	public function setWmidNumber($wmidNumber){
		$this->wmidNUmber = $wmidNumber;
	}
	
	
}