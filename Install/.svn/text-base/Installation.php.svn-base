<?php

class Install_Installation {
	/**
	 *
	 * @var Model_DataBase
	 */
	private $db;

	public function __construct() {
		$this->message ( 'Begin installation' );
		$this->db = new Model_DataBase ( false );
		$this->message ( '1. Connect to MySql server: ' . $this->db->getServer () );
		$this->message ( '2. init database...' );
		$this->initDB ();
		$this->initMappedTables ();

		$this->fillDayLimit();
		$this->message ( '5. Sets day limits' );

		$this->message ( '<br/>COMPLETE!' );
	}

	private function initDB() {
		$this->db->setConnection ( "mysql:host=" . $this->db->getServer (), $this->db->getUser (), $this->db->getPass () );
		$this->db->execute ( "DROP DATABASE IF EXISTS " . $this->db->getDbName () );
		$this->message ( '2.1. drop database if exist: ' . $this->db->getDbName () );
		$this->db->execute ( "CREATE DATABASE IF NOT EXISTS  " . $this->db->getDbName () );
		$this->message ( '2.2. create database if not exist: ' . $this->db->getDbName () );
		$this->db = Application_Registry::getDataBase ();
	}

	private function initMappedTables() {
		$this->message ( '3. create tables...' );
		$metaDataMapper = new ORM_MetaData_Mapper ();
		foreach ( $metaDataMapper->getAllClasses () as $mappedClass ) {
			$this->createTable ( $mappedClass );
		}
	}

	private function fillDayLimit() {
		$manager = Application_Registry::getExchangerManager();
		$exchList = $manager->getExchangesList();
		foreach ($exchList as $exchange) {
			$this->initDayLimit($exchange);
		}
	}

	private function initDayLimit(Exchanger_ExchangesList_Exchange $exchange){
		$dayLimitMapper = new ORM_DataMapper_Exchanger_ExchangesList_Limit();
		$dayLimit = new Exchanger_ExchangesList_Limit();

		$dayLimit->setId($exchange->getExchType());
		$dayLimit->setExchType($exchange->getExchType());
		$dayLimit->setDayLimit($exchange->getDayLimit());
		$dayLimit->setRemains($exchange->getDayLimit());
		$dayLimitMapper->save($dayLimit);
	}


	private function createTable(ORM_MetaData_MetaDataClass $mappedClass) {
		//create table tbl_name (value type, )
		$query = 'CREATE TABLE ' . $mappedClass->getTableName () . '(';
		foreach ( $mappedClass->getIterator () as $propertyName => $propertyType ) {
			$query .= $propertyName . ' ' . $propertyType . ', ';
		}
		$query = ORM_SQL_Utils::removeLastComma ( $query );
		$query .= ') DEFAULT CHARSET=cp1251;';

		$this->db->execute ( $query );
		$this->message ( '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;create table: ' . $mappedClass->getTableName () );
	}

	private function message($text) {
		echo '<br/>' . $text;
	}
}

