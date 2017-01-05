<?php
class ORM_DataMapper_Log_Log extends ORM_DataMapper_AbstractMapper{

	public function __construct(){
		$this->className = 'Log_Log';
		parent::__construct();
	}
	
	/**
	 * @return Core_Collections_ArrayList
	 */
	public function findAll(){
		$logList = $this->findAbstractAll('Date');
		return $logList;
	}
	
	public function deleteAll(){
		$this->abstractDeleteAll();
	}
}