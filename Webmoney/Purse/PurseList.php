<?php
class Webmoney_Purse_PurseList implements Core_Collections_IList{
/**
	 * @var Core_Collections_ArrayList
	 */
	private $list;

	public function __construct(){
		$this->list =  new Core_Collections_ArrayList();
	}

	public function add($purse) {
		if (!($purse instanceof  Webmoney_Purse_Purse)) {
			throw new Exception('параметер не является объектом Webmoney_Purse_Purse');			
		}
		$this->list->add($purse);
	}

	public function iterator(){
		return $this->list->iterator();
	}

	public function get($index){
		return $this->list->get($index);
	}

	public function count(){
		return $this->list->count();
	}
	
	public function isEmpty(){
		return $this->list->isEmpty();
	}
	
	public function clear(){
		$this->list->clear();
	}
}