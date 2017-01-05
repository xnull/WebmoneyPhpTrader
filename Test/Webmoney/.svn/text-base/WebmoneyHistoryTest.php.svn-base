<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}

class WebmoneyHistoryTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	public function testHistory(){
		//$config = new Configs_Config();
		//$config->getChild("WMID")
		 
		//$wmid = "384986898423";
		//$purseNumber = "R114423165162";
	}

	public function testDecodeKey(){
		//$encodeKey = WMSigner_WMSigner::base64Encode(file_get_contents(Core_Loader::getRootDir() . '/Webmoney/384986898423.kwm'));
		//$this->assertEqual(strlen(WMSigner_WMSigner::Base64Decode($encodeKey)), 164, "error str len = " .strlen(WMSigner_WMSigner::Base64Decode($encodeKey)));
		 
		//$this->assertEqual($encodeKey, "1", $encodeKey);
	}

	public function testGetHistory(){
		$history = new Webmoney_Interfaces_History_History();
		$wmidFactory = new Webmoney_WMID_WMIDFactory();
		$wmid = $wmidFactory->getWmidList()->get(0);
		$operations = $history->getHistory($wmid, $wmid->getPurseByType("WMR")->getNumber(), "20100815 00:00", "20100819 23:59:59");
				
		$this->assertEqual($operations->count(), 0, $result->saveXML());
	}
	
	public function testRequest(){
		$httpclient = Application_Registry::getHttpClient ();
		$wmidFactory = new Webmoney_WMID_WMIDFactory();
		$wmid = $wmidFactory->getWmidList()->get(0);
		
		$request = new Webmoney_Interfaces_History_Request ( $wmid->getWmidComposite (), $wmid->getPurseByType("WMR")->getNumber(), "20100805 00:00", "20100809 23:59:59" );
		$request->setWmtranid("419017249");
		$result = $httpclient->httpXmlPost ( $request->getUrl (), $request->getXmlRequest ()->saveXML () );
		
	}
}
?>