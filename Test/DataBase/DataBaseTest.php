<?php
include_once  '../__TestGlobals.php';

class DataBaseTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testExecute() {
		$db = Application_Registry::getDataBase();
		$result = $db->execute("SELECT * FROM mytable");		
	}
	
	function testFindMyPay(){
		$mypayMapper = new ORM_DataMapper_Exchanger_ListMyPays_MyPay();
		$myPay = $mypayMapper->find("123");
		$this->assertEqual($myPay->getId(), '123');
		$this->assertEqual($myPay->getExchType(), '1');
	}
	
	function testGetFailOperation(){
		$mapper = new ORM_DataMapper_Exchanger_OperationResult();
		$oper = $mapper->find("577685547");
		$this->assertEqual($oper->getId(), "1", $oper->getRetdesc());
	}
}
?>
