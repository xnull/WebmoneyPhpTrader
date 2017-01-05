<?php
class ORM_SQL_Insert {
	/**
	 * @var ORM_SQL_Table
	 */
	private $table;
	private $update;
	private $ingnore;

	public function __construct(ORM_SQL_Table $table, $ignore=true){
		$this->table = $table;
		$this->ingnore = $ignore;		
	}

	public function __toString(){
		$ignore = null;
		if ($this->ingnore){
			$ignore = 'IGNORE ';
		}
		
		$query = 'INSERT ' . $ignore . 'INTO ' . $this->table->getName() . ' ';
		$query .= '(' . $this->getAllFields() . ')';
		$query .= $this->getValues();
			 
		return $query;
	}

	private function getAllFields(){		
		$result = null;
		foreach ($this->table->getIterator() as $field) {
			$result .= $field->getName() . ', ';
		}
		$result = ORM_SQL_Utils::removeLastComma($result);	
		return $result;
	}

	private function getValues(){
		$values = ' VALUES ';
		$values .= '(';
		foreach ($this->table->getIterator() as $field) {
			$values .= $field->getValue() . ', ';
		}
		$values = ORM_SQL_Utils::removeLastComma($values);
		$values .= ')';		
		return $values;
	}

	private function getFieldsFromTable(ORM_SQL_Table $table){
		$result = null;
		foreach ($table->getIterator() as $field) {
			$result .= $field->getName() . ', ';
		}
		$result = ORM_SQL_Utils::removeLastComma($result);
		return $result;
	}	
}