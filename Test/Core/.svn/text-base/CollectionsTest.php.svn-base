<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}

class CollectionsTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}
	
	function testHashMap(){
		$hash = new HashMapImpl();
		$hash->add(1,"123");
		$hash->add(2,"1234");
		$hash->add(3,"12345");

		$this->assertEqual($hash->count() , 3);
		$this->assertEqual($hash->getValue(2), "1234");
	}
}

class HashMapImpl extends Core_Collections_HashMap{
	public function add($key, $value){
		parent::add($key, $value);
	}

	public function getValue($key){
		return parent::getValue($key);
	}
}
?>