<?php
include_once '__TestGlobals.php';

class OfficalRatesTest extends UnitTestCase {
	function CBRTest() {
		$this->UnitTestCase();
	}

	public function TestDB(){
		//$date1 = Core_DateTime::format('2010-08-15', 'Y.m.d');
		//$date2 = date('Y.m.d');
		//$dayned = date("l");
		//$this->assertTrue($date1 < $date2);
		//$this->assertEqual($dayned, "Monday", $dayned);
		for ($i=1; $i<100;$i++){
		 $rand = Core_Double::toDouble(rand(1, 4)/100);
		}

	}

	/**
	 public function testRand(){
		$r1 = rand(10, 100);
		$r2 = rand(10, 100);
		$this->assertEqual($r1, $r2);
		}
		*/
}

