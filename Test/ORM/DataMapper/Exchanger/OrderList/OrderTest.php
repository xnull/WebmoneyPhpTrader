<?php
include_once '../../../../__TestGlobals.php';


class OrderTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testOrderMapperSave() {
		$orderMapper = new ORM_DataMapper_Exchanger_OrderList_Order();
		$manager = new Exchanger_Manager();
		$wmid = Application_Registry::getConfig()->getChildNode('WMIDS')->getChildNode('WMID384986898423');
		$firstOrder = $manager->getOrderList(1)->getFirstOrder();		
		$insert = $orderMapper->save($firstOrder);
		//$this->assertEqual($insert, 'you', $insert);

		$findOrder = $orderMapper->find('3674451');
		//$this->assertEqual($findOrder->, $second)
	}
}
?>

