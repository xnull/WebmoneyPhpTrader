<?php
class ORM_DataMapper_Exchanger_OperationResult extends ORM_DataMapper_AbstractMapper{

	public function __construct(){
		$this->className = 'Exchanger_OperationResult';
		parent::__construct();
	}

	/**
	 *
	 * @param unknown_type $id
	 * @return Exchanger_OperationResult
	 */
	public function find($id){
		return $this->findAbstract($id, new $this->className());
	}

	/**
	 * @return Core_Collections_ArrayList
	 */
	public function findAll(){
		$failOperations = $this->findAbstractAll('Date');
		return $failOperations;
	}

	public function deleteAll(){
		$this->abstractDeleteAll();
	}
}