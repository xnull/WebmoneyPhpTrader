<?php
include_once '../__TestGlobals.php';

class DayRemainsTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testTest() {
		$manager = Application_Registry::getExchangerManager();
		$exchange = $manager->getExchangesList()->getExchange("WMZ_WMR");
		$listMyPay = $manager->getListMyPays($this->getWmid(), Exchanger_ListMyPays_BidType::ALLTYPES);
		$myPay = $listMyPay->getIterator()->current();
		
		$dayRemains = new Algorithm_MainChain_HandlePurchase_DayRemains();		
		$dayRemains->run($exchange, $myPay);
	}
	
	private function getWmid(){
		$wmidF = new Webmoney_WMID_WMIDFactory();
		$wmid = $wmidF->getWmidList()->get(0);
		return $wmid->getWmidComposite();
	}
}
?>
