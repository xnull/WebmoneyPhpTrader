<?php
class ORM_DataMapper_Statement {
	/**
	 *
	 * @var ORM_MetaData_MetaDataClass
	 */
	private $metaData;

	public function __construct(ORM_MetaData_MetaDataClass $metaData){
		$this->metaData = $metaData;
	}

	/**
	 * @return ORM_DataMapper_Find
	 */
	public function findStatementAll($orderBy = null) {
		$table = new ORM_SQL_Table ( $this->metaData->getTableName () );
		$table->addField ( new ORM_SQL_Field ( '*' ) );

		$find = new ORM_DataMapper_Find ( $table, $orderBy );
		return $find;
	}

	/**
	 * @return ORM_DataMapper_Find
	 */
	public function findStatement($id) {
		$find = $this->findStatementAll ();
		$field = new ORM_SQL_Field ( 'id', $id );

		$criterion = new ORM_SQL_Criterion ( $field, '=' );
		$where = new ORM_SQL_Where ( $criterion );

		$find->setWhere ( $where );

		return $find;
	}

	/**
	 *
	 * @param Application_DomainObject $domainObject
	 * @return ORM_SQL_Insert
	 */
	public function saveStatement(Application_DomainObject $domainObject) {
		$table = $this->createTableFromDomainObject($domainObject);
		$insert = new ORM_SQL_Insert ( $table);
		return $insert;
	}

	public function updateStatement(Application_DomainObject $domainObject){
		$table = $this->createTableFromDomainObject($domainObject);
		$update = new ORM_SQL_Update ( $table);
		return $update;
	}


	/**
	 *
	 * @param Application_DomainObject $domainObject
	 * @return ORM_SQL_Table
	 */
	private function createTableFromDomainObject(Application_DomainObject $domainObject){
		$table = new ORM_SQL_Table ( $this->metaData->getTableName () );
		foreach ( $this->metaData->getPropertiesIterator () as $property ) {
			$getMethod = 'get' . ucfirst ( $property );
			if (!is_callable ( array ($domainObject, $getMethod ) )) {
				continue;
			}
			if ($domainObject->$getMethod () != null) {
				$field = new ORM_SQL_Field ( $property, '"' . $domainObject->$getMethod () . '"' );
				$table->addField ( $field );
			}
		}
		return $table;
	}
}
