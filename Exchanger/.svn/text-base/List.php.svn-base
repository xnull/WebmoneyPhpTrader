<?php
class Exchanger_List extends Core_Collections_HashMap{
	protected  $wmidNumber;	

	public function getWmidNumber(){
		return $this->wmidNumber;
	}

	public function setWmidNumber($number){
		$this->wmidNumber = $number;
	}

	public function getPay($id){
		return $this->getValue($id);
	}

	public function addPay(Exchanger_Pay $pay){
		$this->add($pay->getId(), $pay);
	}
}