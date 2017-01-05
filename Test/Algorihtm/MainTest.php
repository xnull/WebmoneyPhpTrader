<?php
$testGlobal = realpath(dirname(__FILE__) . '/../__TestGlobals.php');
include_once $testGlobal;

class MainTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testAlgo() {
		$algo = new Algorithm_MainChain_Algorithm();
		$algo->start();
		$this->assertEqual("1", "1");
	}
}

?>
