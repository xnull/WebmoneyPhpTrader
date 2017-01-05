<?php
class ORM_DataMapper_Find{
	/**
	 * @var ORM_SQL_Select
	 */
	private $select;
	/**
	 * @var ORM_SQL_Where
	 */
	private $where;
	
	public function __construct(ORM_SQL_Table $table, $orderBy=null){
		$this->select = new ORM_SQL_Select();
		$this->select->addTable($table);
		$this->select->setOrderBY($orderBy);
	}
	
	public function addTable(ORM_SQL_Table $table){
		$this->select->addTable($table);
	}
	
	public function setWhere(ORM_SQL_Where $where){
		$this->where = $where;
	}

	public function __toString(){
		$result = $this->select;
		if (isset($this->where)) {
			$result .= ' ' . $this->where;
		}
		$result = (string)$result;
		return $result;
	}
}