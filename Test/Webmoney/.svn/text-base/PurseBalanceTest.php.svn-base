<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}

class PurseBalanceTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	public function testBalance(){
		$wmidFactory = new Webmoney_WMID_WMIDFactory();
		$wmid = $wmidFactory->getWmidList()->get(0);
		
		$balance = new Webmoney_Interfaces_Balance();
		$balanceSumm = $balance->getRealSumm($wmid, $wmid->getPurseByType("WMR")->getNumber());
		$this->assertEqual($balanceSumm->saveXML(), "100", $balanceSumm->saveXML());
	}
	
	//public function testBalance2(){
		//$balance = new Webmoney_Interfaces_Balance();
		//$balanceSumm = $balance->get($this->wmid, $this->number);
	//}
}
?>