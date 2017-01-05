<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}

class OrderListTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testList() {
		$orders = new Exchanger_OrderList_OrderList("1");
		
		$this->assertNotNull($orders->getOrder("3534938"));
		$this->assertEqual($orders->getOrder("3534938")->getId(), "3534938");  
		
	}
}

?>
