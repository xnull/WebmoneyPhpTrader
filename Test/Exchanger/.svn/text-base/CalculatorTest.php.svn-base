<?php
if (!defined('AllTests')) {
	include_once '../__TestGlobals.php';
}


class CalculatorTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testCalc() {
		$calc = new Exchanger_Calculator();
		$this->assertEqual($calc->plus(1, 30, 1), 31);
		$this->assertEqual($calc->plus(2, 30, 1), 29);
		$this->assertEqual($calc->plus(3, 30, 1), 31);
		$this->assertEqual($calc->plus(1, 30, -1), 29);
		
		$this->assertTrue($calc->largerThanOrEqual(1, 30, 29));
		$this->assertTrue($calc->largerThanOrEqual(2, 29, 30));
		$this->assertTrue($calc->largerThanOrEqual(1, 30, 30));
		$this->assertTrue($calc->largerThanOrEqual(2, 30, 30));
	}
	
	
}

?>
