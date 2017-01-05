<?php

class OfficalRates_Currency{

	/**
	 * ссылка на класс банка с которого получили курсы вылют
	 * @var OfficalRates_OfficalRates
	 */
	private $bank;
	/**
	 * Сколько единиц данной валюты, обмениваются на базовую
	 */
	private $nominal;
	private $name;
	private $numCode;
	private $charCode;
	private $rate;
	private $rateType;	

	/**
	 * @return OfficalRates_OfficalRates
	 */
	public function getBank(){
		return $this->bank;
	}

	public function getNumCode(){
		return $this->numCode;
	}

	public function getCharCode(){
		return $this->charCode;
	}

	public function getNominal(){
		return $this->nominal;
	}

	/**
	 * Это курс полученный с сайта ЦБ.
	 * этот курс НЕ является курсом который можно использовать для обменов на эксченджере
	 */
	public function getRate(){
		return $this->rate;
	}	

	public function getBaseCurrencyName(){
		return $this->bank->getBaseCurrencyName();
	}

	public function getName(){
		return $this->name;
	}

	public function setBank(OfficalRates_OfficalRates $bank){
		$this->bank = $bank;
	}

	public function setNumCode($numCode){
		$this->numCode = $numCode;
	}

	public function setCharCode($charCode){
		$this->charCode = $charCode;
	}

	public function setNominal($nominal){
		$this->nominal = $nominal;
	}

	public function setRate($rate){
		$this->rate = $rate;
	}

	public function setName($name){
		$this->name = $name;
	}
}

?>