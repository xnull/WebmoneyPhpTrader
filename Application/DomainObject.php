<?php
/**
 * ƒоменный объект, все классы которые будут сохран€тьс€ в базу данных
 * должны быть наследниками этого класса.
 */
abstract class Application_DomainObject {
	protected $id;	
	
	public function setId($id){
		if (!isset($this->id)) {
			$this->id = $id;
		}
	}
	
	public function getId() {
		if (!isset($this->id)) {
			$this->id = $this->generateId();
		} 
		return $this->id;
	}

	private function generateId(){
		return rand(100000000, 1000000000);	
	}
}