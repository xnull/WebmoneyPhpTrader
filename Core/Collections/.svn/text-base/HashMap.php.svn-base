<?php
abstract class Core_Collections_HashMap implements IteratorAggregate{
	protected $hashMap = array();

	/**
	 * @return Core_Collections_IteratorImpl
	 */
	public function getIterator() {
		return new Core_Collections_IteratorImpl($this->hashMap);
	}
	
	public function count(){
		return count($this->hashMap);
	}

	protected function getValue($key){
		if (isset($this->hashMap[$key])) {
			return $this->hashMap[$key];
		}
		throw new Exception('Key ' . $key . ' not exist');
	}

	/**
	 * Добавление элемента в коллекцию
	 * @param Object $key
	 * @param Object $value
	 */
	protected function add($key, $value){
		$this->hashMap[$key] = $value;
	}
	
	protected function clear(){
		$this->hashMap = array();
	}
}

?>