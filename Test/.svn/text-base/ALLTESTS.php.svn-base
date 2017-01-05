<?php

define('AllTests', true);

include_once '__TestGlobals.php';

class AllTests extends TestSuite {

	public function AllTests() {
		$this->TestSuite('All tests');

		$testFolder = Core_Loader::getRootDir() ."/Test/";
		$this->RaznoTest($testFolder);
		$this->coreTest($testFolder . 'Core/');
		$this->ExchangerTest($testFolder . '/Exchanger/');
		$this->HTMLTest($testFolder . '/HTML/');
		$this->ORMMetaDataTest($testFolder . '/ORM/MetaData/');
		$this->ORMSqlTest($testFolder . '/ORM/SQL/');
		//$this->WebmoneyTest($testFolder . '/Webmoney/');
	}

	private function RaznoTest($testFolder){
		//$this->addTestFile($testFolder ."ConfigTest.php");
		$this->addTestFile($testFolder .'DirectionTest.php');
		$this->addTestFile($testFolder .'DOMTest.php');
		$this->addTestFile($testFolder .'LoaderTest.php');
		//$this->addTestFile($testFolder .'OfficalRatesTest.php');
	}

	private function coreTest($testFolder){
		$this->addTestFile($testFolder .'CollectionsTest.php');
		$this->addTestFile($testFolder .'DoubleTest.php');
	}

	private function ExchangerTest($testFolder){
		$this->addTestFile($testFolder .'CalculatorTest.php');
		$this->addTestFile($testFolder .'ExchangesListTest.php');
		$this->addTestFile($testFolder .'ExchangeTest.php');
		$this->addTestFile($testFolder .'ListMyPaysRequestTest.php');
		$this->addTestFile($testFolder .'ExchangesListTest.php');
	}

	private function HTMLTest($testFolder){
		$this->addTestFile($testFolder .'HtmlTest.php');
	}

	private function ORMMetaDataTest($testFolder){
		$this->addTestFile($testFolder .'MapperTest.php');
		$this->addTestFile($testFolder .'MetaDataClassTest.php');
	}

	private function ORMSqlTest($testFolder){
		$this->addTestFile($testFolder .'SqlTest.php');
		$this->addTestFile($testFolder .'UpdateTest.php');
	}

	private function WebmoneyTest($testFolder){
		$this->addTestFile($testFolder .'ComissionTest.php');
		//$this->addTestFile($testFolder .'SerializeTest.php');
		//$this->addTestFile($testFolder .'WebmoneyHistoryTest.php');
	}
}
?>
