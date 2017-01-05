<?php
class Webmoney_WMID_WMID {
	private $number;
	/**
	 *
	 * @var Webmoney_Purse_PurseList
	 */
	private $purseList;

	public function __construct($number){
		$this->purseList = new Webmoney_Purse_PurseList();
		$this->number = $number;
	}

	public function getNumber(){
		return $this->number;
	}

	/**
	 * 
	 * @return Webmoney_WMID_WMIDList
	 */
	public function getPurseList(){
		return $this->purseList;
	}

	public function addPurse(Webmoney_Purse_Purse $purse){
		$this->getPurseList()->add($purse);
	}

	/**
	 *
	 * @param unknown_type $purseType
	 * @return Webmoney_Purse_Purse
	 */
	public function getPurseByType($purseType){
		foreach ($this->getPurseList()->iterator() as $purse){
			if($purse->getType() == $purseType){
				return $purse;
			}
		}
		return null;
	}

	public function iterator(){
		$this->getPurseList()->iterator();
	}

	/**
	 * @return Application_AbstractComposite
	 */
	public function getWmidComposite(){
		$wmidList = Application_Registry::getConfig()->getChildNode('WMIDS');
		$wmid = $wmidList->getChildNode('WMID' . $this->number);
		return $wmid;
	}
}