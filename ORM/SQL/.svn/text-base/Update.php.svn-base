<?php
class ORM_SQL_Update {
	/**
	 * 
	 * @var ORM_SQL_Table
	 */
	private $table;

	public function __construct(ORM_SQL_Table $table){
		$this->table = $table;
	}

	public function __toString(){
		$query = 'UPDATE ' . $this->table->getName() . ' ';
		$query .= 'SET ';
		$query .= $this->getAllFields();
		$query .= ' WHERE id=' . $this->table->getField("id")->getValue();
		return $query;
	}

	private function getAllFields(){
		$allFields = null;
		$allFields .= $this->getFieldsFromTable($this->table) . ', ';
		$allFields = ORM_SQL_Utils::removeLastComma($allFields);
		return $allFields;
	}

	private function getFieldsFromTable(ORM_SQL_Table $table){
		$result = null;
		foreach ($table->getIterator() as $field) {
			if ($field->getName() == 'id') {
				continue;
			}
			$result .= $field->getName() . '=' . $field->getValue() . ', ';
		}
		$result = ORM_SQL_Utils::removeLastComma($result);
		return $result;
	}
}