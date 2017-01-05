<?php
class ORM_DataMapper_Exchanger_ListMyPays_MyPay extends ORM_DataMapper_AbstractMapper{

	public function __construct(){
		$this->className = 'Exchanger_ListMyPays_MyPay';
		parent::__construct();
	}

	/**	
	 * @param int $id
	 * @return Exchanger_ListMyPays_MyPay
	 */
	public function find($id){		
		return $this->findAbstract($id, new Exchanger_ListMyPays_MyPay());
	}
	
	/**
	 * 
	 * @return Core_Collections_ArrayList
	 */
	public function findAll(){
		return $this->findAbstractAll();
	}
}
