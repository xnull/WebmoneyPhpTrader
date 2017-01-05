<?php
class Controller_Log_Controller extends Controller_Controller{
	
	public function index(){		
		$this->view->add("logList" ,$this->getLogRecords());
		$this->view->display();
	}

	public function clear(){		
		$logMapper = new ORM_DataMapper_Log_Log();
		$logMapper->deleteAll();
		$this->view->add("logList" ,$this->getLogRecords());
		$this->view->display();
	}

	private function getLogRecords(){
		$logMapper = new ORM_DataMapper_Log_Log();
		$logList = $logMapper->findAll();
		return $logList;
	}
}