<?php
/**
 * Базовый маппер всех доменных объектов в базу данных
 */
abstract class ORM_DataMapper_AbstractMapper {
	protected $className;
	/**
	 * 
	 * @var ORM_MetaData_MetaDataClass
	 */
	protected $metaData;
	protected $cache = array ();

	public function __construct() {
		$metaDataMapper = new ORM_MetaData_Mapper ();
		$this->metaData = $metaDataMapper->getClass ( $this->className );
	}
	
	/**
	 *
	 * @param $domainObjectName
	 * @return Core_Collections_ArrayList
	 */
	protected function findAbstractAll($orderBy = null) {
		$finder = new ORM_DataMapper_Statement($this->metaData);
		$arrayResult = Application_Registry::getDataBase ()->execute ( $finder->findStatementAll($orderBy) );
		return $this->doLoadAll ( $arrayResult);
	}

	protected function findAbstract($id) {
		if (isset ( $this->cache [$id] )) {
			return $this->cache [$id];
		}

		$finder = new ORM_DataMapper_Statement($this->metaData);
		
		$arrayResult = Application_Registry::getDataBase ()->execute ( $finder->findStatement($id) );
		$this->cache [$id] = $this->doLoad ( $arrayResult );
		return $this->cache [$id];
	}

	/**
	 *
	 * @param unknown_type $resultSet
	 * @return Application_DomainObject
	 */
	protected function doLoad($resultSet) {
		$loader = new ORM_DataMapper_Loader($this->metaData, $this->className);
		return $loader->doLoad($resultSet);
	}

	/**
	 * @param unknown_type $resultSet
	 * @param Application_DomainObject $domainObject
	 * @return Core_Collections_ArrayList
	 */
	protected function doLoadAll($resultSet) {
		$list = new Core_Collections_ArrayList ();
		foreach ( $resultSet as $currentDomainObject ) {
			$list->add ( $this->doLoad ( $currentDomainObject) );
		}
		return $list;
	}	

	public function save(Application_DomainObject $domainObject ) {
		$this->saveAbstract ( $domainObject);
	}

	protected function saveAbstract(Application_DomainObject $domainObject) {
		$statement = new ORM_DataMapper_Statement($this->metaData);
		$arrayResult = Application_Registry::getDataBase ()->execute ( $statement->saveStatement($domainObject) );
	}

	public function update(Application_DomainObject $domainObject ) {
		$this->updateAbstract ( $domainObject);
	}

	protected function updateAbstract(Application_DomainObject $domainObject) {
		$statement = new ORM_DataMapper_Statement($this->metaData);
		$arrayResult = Application_Registry::getDataBase ()->execute ( $statement->updateStatement($domainObject) );
	}
	
	protected function abstractDeleteAll(){
		$tableName = $this->metaData->getTableName();
		$delete = new ORM_SQL_Delete($tableName);
		Application_Registry::getDataBase()->execute($delete);
	}
}