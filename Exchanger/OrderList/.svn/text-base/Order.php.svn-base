<?php
class Exchanger_OrderList_Order extends Application_DomainObject{
	private $exchType;	
	private $amountin;
	private $amountout;
	private $inoutrate;
	private $outinrate;
	private $procentbankrate;
	private $allamountin;
	private $querydate;
	
	public function getAmountin() {
		return Core_Double::toDouble($this->amountin);
	}

	public function getAmountout() {
		return Core_Double::toDouble($this->amountout);
	}

	public function getInoutrate() {
		return Core_Double::toDouble($this->inoutrate);
	}

	public function getOutinrate() {
		return Core_Double::toDouble($this->outinrate);
	}

	public function getProcentbankrate() {
		return Core_Double::toDouble($this->procentbankrate);
	}

	public function getAllamountin() {
		return Core_Double::toDouble($this->allamountin);
	}

	public function getQuerydate() {
		return Core_DateTime::toDateTime($this->querydate);
	}

	public function getExchType(){
		return $this->exchType;
	}	

	public function setAmountin($amountin) {
		$this->amountin = $amountin;
	}

	public function setAmountout($amountout) {
		$this->amountout = $amountout;
	}

	public function setInoutrate($inoutrate) {
		$this->inoutrate = $inoutrate;
	}

	public function setOutinrate($outinrate) {
		$this->outinrate = $outinrate;
	}

	public function setProcentbankrate($procentbankrate) {
		$this->procentbankrate = $procentbankrate;
	}

	public function setAllamountin($allamountin) {
		$this->allamountin =$allamountin;
	}

	public function setQuerydate($querydate) {
		$this->querydate = $querydate;
	}

	public function setExchType($exchType){
		$this->exchType = $exchType;
	}


	public function getRate(){				
		if (Exchanger_Direction::getCursType($this->exchType) == Exchanger_Direction::FORWARD) {
			return Core_Double::toDouble($this->inoutrate);
		}
		else {
			return Core_Double::toDouble($this->outinrate);
		}
		throw new Exception('Rate not correct');
	}
}

?>