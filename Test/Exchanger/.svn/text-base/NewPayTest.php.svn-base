<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}


class NewPayTest extends UnitTestCase {
	function __construct() {
		$this->UnitTestCase ();
	}
	
	
	function testCalc() {
		$exchange = Application_Registry::getExchangerManager()->getExchangesList()->getExchange("WMZ_WMR");
		$wmidF = new Webmoney_WMID_WMIDFactory();
		$wmid = $wmidF->getWmidList()->get(0);
		
		$wmr = $wmid->getPurseByType("WMR");
		$wmz = $wmid->getPurseByType("WMZ");
		
		$manager = Application_Registry::getExchangerManager();
		$myPay = $manager->newPay($wmid->getWmidComposite(), $wmr->getNumber(), $wmz->getNumber(), "30", "1");
	}
	
	
	/**
	public function testYou() {
		$wmid = "384986898423";
		$inpurse = "R114423165162";
		$outpurse = "Z413138348810";
		$inamount = "30";
		$outamount = "1";
		
		$plainStr = $wmid . $inpurse . $outpurse . $inamount . $outamount;
		
		$kwm = Application_Registry::getConfig()->getChildNode("WMIDS")->getChildNode("WMID" . $wmid)->getProperty("kwm");
		$wmSigner = new WMSigner_WMSigner($wmid, "123123123", $kwm);
		$s = $wmSigner->Sign($plainStr);
		 
		
		$query = "<wm.exchanger.request>".
			 "<wmid>$wmid</wmid>". "<signstr>$s</signstr>" . "<inpurse>$inpurse</inpurse>" . 
			 "<outpurse>$outpurse</outpurse>" . "<inamount>$inamount</inamount>" .
			 "<outamount>$outamount</outamount>" . 
			 "</wm.exchanger.request>";
		$r = curl_init();
		curl_setopt ( $r, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt ( $r, CURLOPT_URL, 'https://wm.exchanger.ru/asp/XMLTrustPay.asp' );		
		curl_setopt ( $r, CURLOPT_RETURNTRANSFER, true );	
		curl_setopt ( $r, CURLOPT_POST, 1 );
		curl_setopt ( $r, CURLOPT_POSTFIELDS, $query );
		$out = curl_exec ( $r );
	}
	*/
}

?>
