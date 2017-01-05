<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}


class ListMyPaysRequestTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testGetListMyPays() {
		$config = new Configs_Config();
		$listMyPays = new Exchanger_ListMyPays_Request($this->getWmid(), Exchanger_ListMyPays_BidType::ALLTYPES);
		//$this->assertEqual($listMyPays->getXmlRequest()->saveXML(), "123", $listMyPays->getXmlRequest()->saveXML());
		$this->assertEqual($listMyPays->getUrl(), "https://wm.exchanger.ru/asp/XMLWMList2.asp");
	}
	
	private function getWmid(){
		$wmidFactory = new Webmoney_WMID_WMIDFactory();
		$wmid = $wmidFactory->getWmidList()->get(0)->getWmidComposite();
		return $wmid;
	}
}

?>