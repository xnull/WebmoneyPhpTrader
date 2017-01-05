<?php

/**
 * Маппер истории на базу.
 * Обрабатывает 2 объекта - мой платеж и купленный ордер
 * и пишет в базу.
 * Логику условий, выборки из базы моего объекта и покупаемого продумать - чтоб можно было привязывать
 * к плажеу другой платеж.
 */
class ORM_DataMapper_Exchanger_History extends ORM_DataMapper_AbstractMapper{

	public function __construct(){
		$this->className = 'Exchanger_History';
		parent::__construct();
	}

	public function save(Exchanger_History $history){
		//TODO если есть дубликаты надо апдейтить май пэй и ордер покупаемый
		
		//сохраняем MyPay
		$myPayMapper = new ORM_DataMapper_Exchanger_ListMyPays_MyPay();
		$myPayMapper->save($history->getMyPay());

		//сохраняем пурчейс
		$purchasedOrderMapper = new ORM_DataMapper_Exchanger_OrderList_Order();
		$purchasedOrderMapper->save($history->getPurchasedOrder());

		//берем ид обоих объектов, берем таблицу для хистори, и добавляем в таблицу строку
		$this->saveAbstract($history);
	}
	
	/**
	 * @return Core_Collections_ArrayList
	 */
	public function findAll(){
		$historyList = $this->findAbstractAll("date desc");
		$listMyPays = $this->toArrayAssoc($this->getListMyPays());
		$purchasedOrderList = $this->toArrayAssoc($this->getPurchasedOrderList());		
		
		foreach ($historyList->iterator() as $history) {
			//$history = new Exchanger_History();
			$history->setMyPay($listMyPays[$history->getMyPayId()]);
			$history->setPurchasedOrder($purchasedOrderList[$history->getPurchasedOrderId()]);			
		}
		return $historyList;
	}
	
	/**
	 * @return Core_Collections_ArrayList
	 */
	public function findRecords($beginDate, $endDate){
		$arrayResult = Application_Registry::getDataBase()
			->execute ("Select * from myTable where(date > $beginDate and date < $endDate)");
		$historyList = $this->doLoadAll ( $arrayResult);
		
		/*
		$table = new ORM_SQL_Table ( $this->metaData->getTableName () );
		$table->addField ( new ORM_SQL_Field ( '*' ) );
		
		$dateStart = new ORM_SQL_Field ( 'date',  $beginDate);
		$beginDateCriterion = new ORM_SQL_Criterion ( $dateStart, '>' );
		
		$dateFinish = new ORM_SQL_Field ( 'date',  $endDate);
		$endDateCriterion = new ORM_SQL_Criterion ( $dateFinish, '<' );
				
		$where = new ORM_SQL_Where($beginDateCriterion);
		$where->addAND($endDateCriterion);
		
		$find = new ORM_DataMapper_Find ( $table, "date desc" );
		$find->setWhere($where);
		*/
		
		$historyList = $this->findAbstractAll("date desc");
		$listMyPays = $this->toArrayAssoc($this->getListMyPays());
		$purchasedOrderList = $this->toArrayAssoc($this->getPurchasedOrderList());		
		
		foreach ($historyList->iterator() as $history) {
			//$history = new Exchanger_History();
			$history->setMyPay($listMyPays[$history->getMyPayId()]);
			$history->setPurchasedOrder($purchasedOrderList[$history->getPurchasedOrderId()]);			
		}
		return $historyList;
	}
	
	
	/**
	 * 
	 * @return Core_Collections_ArrayList
	 */
	private function getListMyPays(){
		$myPayMapper = new ORM_DataMapper_Exchanger_ListMyPays_MyPay();
		return $myPayMapper->findAll();
	}
	
	/**
	 * 
	 * @return Core_Collections_ArrayList
	 */
	private function getPurchasedOrderList(){
		$purchListMapper = new ORM_DataMapper_Exchanger_OrderList_Order();
		return $purchListMapper->findAll();
	}
	
	/**
	 * 
	 * @param Core_Collections_ArrayList $listDomainObjects
	 * @return array()
	 */
	private function toArrayAssoc(Core_Collections_ArrayList $listDomainObjects){
		$assocArr = array();
		foreach ($listDomainObjects->iterator() as $domainObject){
			$assocArr[$domainObject->getId()] = $domainObject;
		}
		return $assocArr;
	}
}