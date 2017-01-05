<?php
class ORM_SQL_Where{
	private $criterions = array();

	/**
	 * select * from x where (id='123' and name='vasya' or id>'12345');
	 *        fields table    (field criterion)
	 */
	public function __construct(ORM_SQL_Criterion $criterion){
		$this->criterions[] = $criterion;
	}

	public function addAND(ORM_SQL_Criterion $criterion){
		$criterion->setInterCriterionExpression('AND');
		$this->criterions[] = $criterion;
	}

	public function addOR(ORM_SQL_Criterion $criterion){
		$criterion->setInterCriterionExpression('OR');
		$this->criterions[] = $criterion;
	}
	
	public function __toString(){
		$query = 'WHERE (';
		//$criterion = new ORM_SQL_Criterion();
		foreach ($this->criterions as $criterion) {
			$query .= $criterion->getInterCriterionExpression() . ' ' ;
			$query .= $criterion->getField()->getName() . $criterion->getSqlOperator() . '"' . $criterion->getField()->getValue() . '" ';
		}
		$query .= ')';
		return $query;
	}

}