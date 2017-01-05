<?php
class Core_Collections_IteratorImpl implements Iterator{
	private $collection = array();

	public function __construct($array) {
		if (is_array($array) ) {
			$this->collection = $array;
		}
	}
	/**
	 * @return Core_Collections_IteratorImpl
	 */
	public function rewind() {
		reset($this->collection);
		return $this;
	}
	/**
	 * @return Core_Collections_IteratorImpl
	 */
	public function current() {
		return current($this->collection);
	}
	
	public function key() {
		return key($this->collection);
	}
	
	/**
	 * @return Core_Collections_IteratorImpl
	 */
	public function next() {
		return next($this->collection);
	}

	public function valid() {
		return $this->current() !== false;
	}
}