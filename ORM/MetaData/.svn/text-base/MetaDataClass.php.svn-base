<?php
class ORM_MetaData_MetaDataClass extends  Core_Collections_HashMap{
	/**
	 *
	 * @var DOMElement
	 */
	private $xmlMetaData;
	private $tableName;
	private $className;	

	public function __construct(DOMElement $xmlElement) {
		$this->xmlMetaData = $xmlElement;
		$this->tableName = $xmlElement->getAttribute('table');
		$this->className = $xmlElement->getAttribute('class');

		$this->initProperties();
	}

	private function initProperties(){
		foreach ($this->xmlMetaData->childNodes as $childNode) {
			if ($childNode->nodeName == 'property') {
				$this->hashMap[$childNode->getAttribute('name')] = $childNode->getAttribute('type');
			}
		}
	}

	public function getTableName() {
		return $this->tableName;
	}

	public function getClassName(){
		return $this->className;
	}

	public function getPropertyType($propertyName){
		return $this->getValue($propertyName);
	}

	/**
	 * 
	 * @return Core_Collections_IteratorImpl
	 */
	public function getPropertiesIterator(){		
		$propArray = array();
		foreach ($this->getIterator() as $propertyName => $propertyType) {
			$propArray[] = $propertyName;
		}		
		return new Core_Collections_IteratorImpl($propArray);
	}
}

