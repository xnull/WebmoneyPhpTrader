<?php
class Webmoney_Purse_Purse extends Application_DomainObject{
	private $type;
	private $number;
	private $balance;
	
	/**
	 *
	 * @var Webmoney_WMID_WMID
	 */
	private $wmid;

	public function getType(){
		return $this->type;
	}

	public function getNumber(){
		return $this->number;
	}	

	/**
	 * @return Webmoney_WMID_WMID
	 */
	public function getWmid(){
		if (!isset($this->wmid)) {
			$wmidFactory = new Webmoney_WMID_WMIDFactory();
			$wmidList = $wmidFactory->getWmidList();
			foreach ($wmidList->iterator() as $wmid) {
				foreach ($wmid->getPurseList()->iterator() as $purse) {
					if($purse->getNumber() == $this->number){						
						$this->wmid = $wmid;
						$wmid->addPurse($this);
						break;
					}
				}
			}			
		}
		if (!isset($this->wmid)) {
			throw new Exception('wmid for purse ' . $this->number . ' not found');
		}
		return $this->wmid;
	}

	public function getBalance(){
		$balance = new Webmoney_Interfaces_Balance();
		return $balance->get($this->wmid, $this->number);
	}

	public function setType($type){
		$this->type = $type;
	}

	public function setNumber($number){
		$this->number = $number;
	}

	public function setWmid(Webmoney_WMID_WMID $wmid){
		$this->wmid = $wmid;
	}
}