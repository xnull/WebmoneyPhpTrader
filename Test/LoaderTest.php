<?php
include_once '__TestGlobals.php';

class LoaderTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}
	
	public function testLoadConfig(){
		/**
		 * @var Configs_Config
		 */
		$config = new Configs_Config();
		$this->assertEqual($config->getName(), "Configs_Config");
	}

	
}
