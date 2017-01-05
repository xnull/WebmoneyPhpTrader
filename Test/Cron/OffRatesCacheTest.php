<?php
include_once '../__TestGlobals.php';





class OffRatesCacheTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}
	
	function testOffRates(){
		$ratesCache = new Cron_scripts_OffRatesCache();
		$ratesCache->run();
		
	}
}

?>