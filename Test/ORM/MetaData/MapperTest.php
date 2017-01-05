<?php
if (!defined('AllTests')) {
	include_once '../../__TestGlobals.php';
}

class MapperTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testGetORM_DataMapper_Exchanger_ListMyPays_MyPay() {
		$metaDataMapper = new ORM_MetaData_Mapper();
		$metaData = $metaDataMapper->getClass('Exchanger_ListMyPays_MyPay');
		$this->assertEqual($metaData->getClassName(), 'Exchanger_ListMyPays_MyPay');
		$this->assertEqual($metaData->getTableName(), 'MyPay');
		$this->assertEqual($metaData->getPropertyType('exchtype'), 'int');		
	}
	
	//function testGetAllClasses(){
		//$metaDataMapper = new ORM_MetaData_Mapper();
		//$x = $metaDataMapper->getAllClasses();		
	//}
}
?>

