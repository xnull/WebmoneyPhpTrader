<?php
class ORM_SQL_Select {
	private $tables = array();
	private $orderBy;
	
	public function setOrderBY($fieldName){
		$this->orderBy = $fieldName;
	}
	
	private function getOrderBY(){
		if ($this->orderBy == null) {
			return null;
		}
		$result = 'ORDER BY ' . $this->orderBy;
		return  $result;
	}

	public function addTable(ORM_SQL_Table $table){
		$this->tables[] = $table;
	}

	public function __toString(){
		$query = 'SELECT ';
		$query .= $this->getAllFields();
		$query .= $this->getFrom() . ' ';
		$query .= $this->getOrderBY();
		return $query;
	}

	private function getAllFields(){
		$allFields = null;
		foreach ($this->tables as $table) {
			$allFields .= $this->getFieldsFromTable($table) . ', ';
		}
		$allFields = ORM_SQL_Utils::removeLastComma($allFields);
		return $allFields;
	}

	private function getFieldsFromTable(ORM_SQL_Table $table){
		$result = null;
		foreach ($table->getIterator() as $field) {
			$result .= $table->getName() . '.' . $field->getName() . ', ';
		}
		$result = ORM_SQL_Utils::removeLastComma($result);
		return $result;
	}
	
	private function getFrom(){
		$tablesNames = ' FROM ';
		foreach ($this->tables as $table) {
			if (!stripos($tablesNames, $table->getName())) {
				$tablesNames .= $table->getName() . ', ';
			}
		}
		$tablesNames = ORM_SQL_Utils::removeLastComma($tablesNames);
		return $tablesNames;
	}
}