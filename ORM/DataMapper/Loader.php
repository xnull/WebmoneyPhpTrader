<?php
class ORM_DataMapper_Loader{
	private $className;
	/**
	 * 
	 * @var ORM_MetaData_MetaDataClass
	 */
	private $metaData;
	
	public function __construct(ORM_MetaData_MetaDataClass $metaData, $className){
		$this->className = $className;
		$this->metaData = $metaData;
	}
	
	/**
	 *
	 * @param unknown_type $resultSet
	 * @return Application_DomainObject
	 */
	public function doLoad($resultSet) {
		if (isset ( $resultSet [0] )) {
			$resultSet = $resultSet [0];
		}
		if (! isset ( $resultSet )) {
			return null;
		}

		$domainObjectName = $this->className;
		$domainObject = new $domainObjectName ();
		foreach ( $this->metaData->getPropertiesIterator () as $property ) {
			$setMethod = 'set' . ucfirst ( $property );
			if (!is_callable ( array ($domainObject, $setMethod ) )) {
				continue;
			}
				
			if (!isset($resultSet [$property])) {
				continue;
			}
			$domainObject->$setMethod ( $resultSet [$property] );
		}
		return $domainObject;
	}

	/**
	 * @param unknown_type $resultSet
	 * @return Core_Collections_ArrayList
	 */
	public function doLoadAll($resultSet) {
		$list = new Core_Collections_ArrayList ();
		foreach ( $resultSet as $currentDomainObject ) {
			$list->add ( $this->doLoad ( $currentDomainObject) );
		}
		return $list;
	}
}