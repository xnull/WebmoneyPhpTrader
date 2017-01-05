<?php
include_once '../../../../__TestGlobals.php';


class MyPayTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testMyPayMapper() {
		$myPayMapper = new ORM_DataMapper_Exchanger_ListMyPays_MyPay();
		$manager = new Exchanger_Manager();
		$wmid = Application_Registry::getConfig()->getChildNode('WMIDS')->getChildNode('WMID384986898423');
		$listMyPays = $manager->getListMyPays($wmid, Exchanger_ListMyPays_BidType::ALLTYPES); 
		$myPay = $listMyPays->getIterator()->current();
		$insert = $myPayMapper->save($myPay);
		$this->assertEqual($insert, 'you', $insert);		
	}
}
?>

