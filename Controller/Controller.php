<?php
abstract class Controller_Controller {
	/**
	 * 
	 * @var View_View
	 */
	protected $view;
	
	/**
	 * @var Application_Request
	 */
 	protected $request;
 	
 	public function __construct(Application_Request $request){
 		$this->request = $request;
 		$this->setView($this->getViewClassName()); 		
 	}
 	
	
	public function getView(){
		return $this->view;
	}
	
	public function setView($viewClassName){
		$viewName = $viewClassName;
		$this->view = new $viewName(); 
	}

	protected function getViewClassName(){
		return str_replace("Controller", "View", get_class($this));		
	}
	
	/**
	 * ¬ыполн€емое контроллером действие по умолчанию 
	 */
	abstract function index();	
} 

?>