<?php
if (!defined('AllTests')) {
	include_once '../../__TestGlobals.php';
}


class MetaDataClassTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testORM_DataMapper_Exchanger_ListMyPays_MyPay() {
		$dom = new DOMDocument('1.0','Windows-1251');
		$dom->load(Core_Loader::getRootDir() . '/ORM/MetaData/MetaData.xml');
		$xpath = new DOMXPath($dom);
		$metaXmlNode = $xpath->query('//class[@class="Exchanger_ListMyPays_MyPay"]')->item(0);
		$metaData = new ORM_MetaData_MetaDataClass($metaXmlNode);
		$this->assertEqual($metaData->getClassName(), 'Exchanger_ListMyPays_MyPay');
		$this->assertEqual($metaData->getTableName(), 'MyPay');
		$this->assertEqual($metaData->getPropertyType('id'), 'int primary key');		
	}
}
?>

