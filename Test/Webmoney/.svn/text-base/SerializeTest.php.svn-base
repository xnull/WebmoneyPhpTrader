<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}


class SerializeTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}	

	public function testDecodeKey(){
		$encodeKey = WMSigner_WMSigner::base64Encode(file_get_contents(Core_Loader::getRootDir() . '/Webmoney/346563783130.kwm'));
		$this->assertEqual(strlen(WMSigner_WMSigner::Base64Decode($encodeKey)), 164, "error str len = " .strlen(WMSigner_WMSigner::Base64Decode($encodeKey)));
		 
		$this->assertEqual($encodeKey, "1", $encodeKey);
	}

	
}
?>