<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}

class ListMyPaysTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testGetListMyPays() {
		$manager = new Exchanger_Manager();
		$wmidF = new Webmoney_WMID_WMIDFactory();
		$wmid = $wmidF->getWmidList()->get(0);
		
		$listMyPays = $manager->getListMyPays($wmid->getWmidComposite(), Exchanger_ListMyPays_BidType::ALLTYPES);		
	}
}

?>
