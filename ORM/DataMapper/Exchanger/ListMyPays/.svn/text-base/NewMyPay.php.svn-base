<?php
class ORM_DataMapper_Exchanger_ListMyPays_NewMyPay extends ORM_DataMapper_AbstractMapper{

	public function __construct(){
		$this->className = 'Exchanger_OperationResultNewPay';
		parent::__construct();
	}

	/**	
	 * @param int $id
	 * @return Exchanger_OperationResultNewPay
	 */
	public function find($id){		
		return $this->findAbstract($id, new $this->className());
	}
	
	/**
	 * 
	 * @return Core_Collections_ArrayList
	 */
	//public function findAll(){
		//return $this->findAbstractAll();
	//}
}
