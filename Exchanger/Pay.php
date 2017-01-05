<?php
abstract class Exchanger_Pay extends Application_DomainObject{
	protected $exchtype;
	protected $state;
	protected $amountin;
	protected $amountout;
	protected $inoutrate;
	protected $outinrate;
	protected $inpurse;
	protected $outpurse;
	protected $querydatecr;
	protected $querydate;
	protected $direction;

	/**
	 * Получить описание статуса заявки.
	 * @see Exchanger/Exchanger_Pay#getStateDescription()
	 */
	public abstract function getStateDescription();

	public function GetRate() {
		if ($this->exchtype %2 == 0) {
			return $this->inoutrate;
		}
		else {
			return $this->outinrate;
		}
		throw new Exception('Направление обмена (exchType) не является числом');
	}

	public function GetRateExchanger() {
		if (Exchanger_Direction::getCursType($this->exchtype) == Exchanger_Direction::FORWARD) {
			return Core_Double::toDouble($this->inoutrate);
		}
		else {
			return Core_Double::toDouble($this->outinrate);
		}
	}


	public function getSumm(){
		if ($this->exchtype %2 == 0) {
			return $this->amountin;
		}
		else {
			return $this->amountout;
		}
		throw new Exception('Направление обмена (exchType) не является числом');
	}

	public function getExchType(){
		return $this->exchtype;
	}

	public function getReverseExchType(){
		return Exchanger_Direction::getReverseExchType($this->exchtype);
	}

	public function getState(){
		return $this->state;
	}

	public function getAmountin(){
		return Core_Double::toDouble($this->amountin);
	}

	public function getAmountOut(){
		return Core_Double::toDouble($this->amountout);
	}

	public function getInOutRate(){
		return Core_Double::toDouble($this->inoutrate);
	}

	public function getOutInRate(){
		return Core_Double::toDouble($this->outinrate);
	}

	public function getInPurse(){
		return $this->inpurse;
	}

	public function getOutPurse(){
		return $this->outpurse;
	}

	public function getQueryDate(){
		return Core_DateTime::toDateTime($this->querydate);
	}

	public function getQueryDateCr(){
		return Core_DateTime::toDateTime($this->querydatecr);
	}

	public function getDirection(){
		return str_replace('-', '_', $this->direction);
	}




	public function setExchType($exchType){
		$this->exchtype = $exchType;
	}

	public function setState($state){
		$this->state = $state;
	}

	public function setAmountin($amountin){
		$this->amountin = $amountin;
	}

	public function setAmountOut($amountout){
		$this->amountout = $amountout;
	}

	public function setInOutRate($inoutrate){
		$this->inoutrate = $inoutrate;
	}

	public function setOutInRate($outinrate){
		$this->outinrate = $outinrate;
	}

	public function setInPurse($inpurse){
		$this->inpurse = $inpurse;
	}

	public function setOutPurse($outpurse){
		$this->outpurse =$outpurse;
	}

	public function setQueryDate($querydate){
		$this->querydate = $querydate;
	}

	public function setQueryDateCr($querydatecr){
		$this->querydatecr = $querydatecr;
	}

	public function setDirection($direction){
		$this->direction =$direction;
	}
}
?>