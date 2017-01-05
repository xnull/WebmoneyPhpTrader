<?php
class ORM_SQL_Table {
	private $name;
	private $fields = array();

	public function __construct($name) {
		if (isset($name)) {
			$this->name = $name;
		}
		else{
			throw new Exception('Имя таблицы должно быть задано');
		}
	}

	public function addField(ORM_SQL_Field $field){
		$this->fields[] = $field;
	}
	
	public function getIterator(){
		return $this->fields;
	}
	
	/**
	 * 
	 * @param unknown_type $name
	 * @return ORM_SQL_Field
	 */
	public function getField($name){
		foreach ($this->fields as $field){			
			if ($field->getName() == $name) {
				return $field;
			} 
		}
		return null;
	}
	
	public function getName(){
		return $this->name;
	}

}