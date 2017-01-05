<?php
class Controller_ConfigEditor_Controller extends Controller_Controller{
	
	public function index(){
		$this->view->add('newConfig', Application_Registry::getConfig()->getXMLDocument()->saveXML());		
		$this->view->display();
	}	
	
	public function edit(){
		$newConfigStr = $this->request->getPostParam("newConfig");		
		
		$newConfig = new DOMDocument();
		$newConfig->loadXML($newConfigStr);
		
		$config = Application_Registry::getConfig();
		$config->setXMLDocument($newConfig);
		$config->save();
		
		$this->view->add('newConfig', $newConfigStr);
		$this->view->display();
	}
}