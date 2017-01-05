<?php
interface Core_Collections_IList{
	public function add($element);

	public function clear();

	public function count();

	public function get($index);

	public function iterator();

	public function isEmpty();
}