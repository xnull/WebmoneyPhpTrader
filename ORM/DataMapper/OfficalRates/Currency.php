<?php
class ORM_DataMapper_OfficalRates_Currency extends ORM_DataMapper_AbstractMapper{

	public function __construct(){
		$this->className = 'OfficalRates_Currency';
		parent::__construct();
	}

	/**
	 * @param int $id
	 * @return Exchanger_ListMyPays_MyPay
	 */
	public function find($id){		
		return $this->findAbstract($id);
	}

	public function save(Application_DomainObject $domainObject){
		$this->saveAbstract($domainObject);
	}
}