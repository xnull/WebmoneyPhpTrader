<?php
class ORM_SQL_Delete {
	private $table;
	
	public function __construct($table){
		$this->table = $table;
	}
	
	public function __toString(){
		$query = 'DELETE FROM ' . $this->table;
		return $query;
	}
}