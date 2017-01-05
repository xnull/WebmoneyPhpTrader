<?php
include_once '../../../__TestGlobals.php';


class HistoryTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}
	
	public function testFindAll(){
		$histMapper = new ORM_DataMapper_Exchanger_History();
		$result = $histMapper->findAll();
	}

	function testHist() {		
		$myPay = $this->getMyPay();		
		$order = $this->getOrder();
		
		$hist = new Exchanger_History();
		$hist->setMyPay($myPay);
		$hist->setPurchasedOrder($order);

		$histMapper = new ORM_DataMapper_Exchanger_History();
		$histMapper->save($hist);
	}
	
	private function getMyPay(){
		$manager = new Exchanger_Manager();
		$wmid = Application_Registry::getConfig()->getChildNode('WMIDS')->getChildNode('WMID384986898423');
		$listMyPays = $manager->getListMyPays($wmid, Exchanger_ListMyPays_BidType::ALLTYPES); 
		$myPay = $listMyPays->getIterator()->current();
		return $myPay;
	}

	private function getOrder(){
		$manager = new Exchanger_Manager();
		$wmid = Application_Registry::getConfig()->getChildNode('WMIDS')->getChildNode('WMID384986898423');
		$firstOrder = $manager->getOrderList(1)->getFirstOrder();	
		return $firstOrder;
	}
}

?>
