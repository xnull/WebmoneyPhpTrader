<?php
include_once '__TestGlobals.php';


class ConfigTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testConfig() {
		$config = new Configs_Config();
		$this->assertEqual($config->getChildNode("Net")->getChildNode("Proxy")->getProperty("useProxy"), "yes");
		//$this->assertEqual($config->getChildNode("Exchanger")->getChildNode("Direction")->getChildNode("WMZ_WMR")->getName(), "WMZ_WMR");
	}
}
?>
