<?php
class ORM_MetaData_Mapper {
	/**
	 * 
	 * @var DOMDocument
	 */
	private $xmlMetaData;
	
	public function __construct(){
		$this->xmlMetaData = new DOMDocument('1.0', 'Windows-1251');
		$pathToXmlConfig = Core_Loader::getRootDir() . '/ORM/MetaData/MetaData.xml';
		if (file_exists($pathToXmlConfig)) {
			$this->xmlMetaData->load($pathToXmlConfig);;
		}
		else {
			throw new Exception('Конфигурационный файл с мета данными для классов не найден');
		}
		
	}
	
	/**	  
	 * Получение объекта с метаданными для конкретного доменного объекта
	 * @param String $name
	 * @return ORM_MetaData_MetaDataClass
	 */
	public function getClass($name){
		$xpath = new DOMXPath($this->xmlMetaData);
		$xmlClassNode = $xpath->query('//class[@class="' . $name . '"]')->item(0);
		return new ORM_MetaData_MetaDataClass($xmlClassNode);		
	}
	
	/**
	 * 
	 * @return Core_Collections_IteratorImpl
	 */
	public function getAllClasses(){
		$metaDataClassesArray = array();
		$xpath = new DOMXPath($this->xmlMetaData);
		$xmlClasses = $xpath->query('//class');
		foreach ($xmlClasses as $xmlClass) {
			$metaDataClassesArray[] = new ORM_MetaData_MetaDataClass($xmlClass);
		}
		return new Core_Collections_IteratorImpl($metaDataClassesArray);
	}
}