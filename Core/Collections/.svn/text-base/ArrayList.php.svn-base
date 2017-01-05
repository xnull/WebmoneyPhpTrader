<?php
class Core_Collections_ArrayList implements Core_Collections_IList {
	private $list = array();

	public function add($element){
		$this->list[count($this->list)] = $element;
	}

	public function clear(){
		unset($this->list);
		$this->list = array();
	}

	public function count(){
		return count($this->list);
	}
	
	public function get($index){
		return $this->list[$index];
	}
	
	public function iterator() {
		return new Core_Collections_IteratorImpl($this->list);
	}
	
	public function isEmpty(){
		if ($this->count() > 0) {
			return flase;
		}
		return true;
	}
}