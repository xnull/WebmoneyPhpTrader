<?php
class ORM_SQL_Criterion{
	private $field;
	private $sqlOperator;	
	private $interCriterionExpression;

	public function __construct(ORM_SQL_Field $field, $sqlOperator){
		$this->field = $field;
		$this->sqlOperator = $sqlOperator;
	}

	public function setInterCriterionExpression($expression = null){
		$this->interCriterionExpression = $expression;
	}

	public function getInterCriterionExpression(){
		return $this->interCriterionExpression;
	}
	
	/**
	 * @return ORM_SQL_Field
	 */
	public function getField(){
		return $this->field;
	}
	
	public function getSqlOperator(){
		return $this->sqlOperator;
	}
}