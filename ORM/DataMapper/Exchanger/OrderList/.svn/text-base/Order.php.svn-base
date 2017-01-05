<?php
class ORM_DataMapper_Exchanger_OrderList_Order extends ORM_DataMapper_AbstractMapper{

	public function __construct(){
		$this->className = 'Exchanger_OrderList_Order';
		parent::__construct();
	}

	/**	
	 * @param int $id
	 * @return Exchanger_ListMyPays_MyPay
	 */
	public function find($id){		
		return $this->findAbstract($id, new Exchanger_OrderList_Order());
	}

	/**
	 * 
	 * @return Core_Collections_ArrayList
	 */
	public function findAll(){
		return $this->findAbstractAll();
	}
	
}
