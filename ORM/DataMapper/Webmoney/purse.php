<?php
class ORM_DataMapper_Webmoney_Purse extends ORM_DataMapper_AbstractMapper{

	public function __construct(){
		$this->className = 'Webmoney_Purse';
		parent::__construct();
	}

	/**	
	 * @param int $id
	 * @return Webmoney_Purse
	 */
	public function find($id){		
		return $this->findAbstract($id);
	}
	
	/**
	 * 
	 * @param $number
	 * @return Webmoney_Purse
	 */
	public function findByPurseNumber($number){
		$this->find($number);
	}
}
