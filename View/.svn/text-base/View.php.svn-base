<?php
abstract class View_View{	
	protected $vars = array();
	
	public function display(){
		include_once Core_Loader::getRootDir() . "/View/Template.php";
	}
	
	public function add($name, $content){		
		$this->vars[$name] = $content;
	}
	
	public function getVar($name){
		return $this->vars[$name];
	}	
	
	protected abstract function renderView();
	
	public static function getViewFolderPath(){
		return Core_Loader::getRootDir() . '/View'; 
	}
}

?>