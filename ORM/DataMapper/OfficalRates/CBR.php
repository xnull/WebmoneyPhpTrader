<?php
class ORM_DataMapper_OfficalRates_CBR extends ORM_DataMapper_AbstractMapper{
	public function __construct(){
		$this->className = 'OfficalRates_CBR';
		parent::__construct();
	}

	/**
	 * @param int $id
	 * @return Exchanger_ListMyPays_MyPay
	 */
	public function find($id){		
		return $this->findAbstract($id);
	}
	
	public function findAll(){
		//$this->domainObject = new OfficalRates_CBR();
		return $this->findAllAbstract();
	}
}