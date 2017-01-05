<?php
class Controller_Fail_Controller extends Controller_Controller{

	public function index(){		
		$this->view->add("failOperations" ,$this->getFailOperations());
		$this->view->display();
	}

	public function clear(){
		$logMapper = new ORM_DataMapper_Exchanger_OperationResult();
		$logMapper->deleteAll();
		$this->view->add("failOperations" ,$this->getFailOperations());
		$this->view->display();
	}
	
	private function getFailOperations(){
		$failOperationsMapper = new ORM_DataMapper_Exchanger_OperationResult();
		$failOperations = $failOperationsMapper->findAll();
		return $failOperations;
	}
}