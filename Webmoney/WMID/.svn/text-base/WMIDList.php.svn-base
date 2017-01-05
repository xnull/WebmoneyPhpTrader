<?php
class Webmoney_WMID_WMIDList{
	/**
	 * @var Core_Collections_ArrayList
	 */
	private $wmidList;

	public function __construct(){
		$this->wmidList =  new Core_Collections_ArrayList();
	}

	public function add($wmid) {
		if (!($wmid instanceof Webmoney_WMID_WMID)) {
			throw new Exception('Переменная WMID не является объектом Webmoney_WMID_WMID');
		}
		$this->wmidList->add($wmid);		
	}
	/**
	 * @return Core_Collections_IteratorImpl
	 */
	public function iterator(){
		return $this->wmidList->iterator();
	}

	/**
	 * @return Webmoney_WMID_WMID
	 */
	public function get($index){
		return $this->wmidList->get($index);
	}
	
	/**
	 * 
	 * @param unknown_type $wmidNumber
	 * @return Webmoney_WMID_WMID
	 */
	public function getWmidByNumber($wmidNumber){
		foreach ($this->wmidList->iterator() as $wmid){
			//$wmid = new Webmoney_WMID_WMID();
			if ($wmid->getNumber() == $wmidNumber) {
				return $wmid;
			}
		}
		return null;
	}

	public function count(){
		return $this->wmidList->count();
	}
	
	public function isEmpty(){
		return $this->wmidList->isEmpty();
	}
	
	public function clear(){
		$this->wmidList->clear();
	}
}