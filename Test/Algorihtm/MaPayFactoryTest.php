<?php
include_once '../__TestGlobals.php';

class MaPayFactoryTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testCreate() {
		$exchange = Application_Registry::getExchangerManager()->getExchangesList()->getExchange("WMZ_WMR");
		$wmidF = new Webmoney_WMID_WMIDFactory();
		$wmid = $wmidF->getWmidList()->get(0);
		
		$mpf = new Algorithm_MainChain_HandleExchange_MyPayFactory();
		$myPay = $mpf->createMyPay($exchange, $wmid);
		$this->assertNotNull($myPay);
	}
}

?>
