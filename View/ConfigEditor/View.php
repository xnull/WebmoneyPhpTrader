<?php
class View_ConfigEditor_View extends View_View{

	protected function renderView(){
		include_once  View_View::getViewFolderPath() .'/ConfigEditor/Template.php';
	}

	private function getConfig(){
		$config = Application_Registry::getConfig()->getXMLDocument()->saveXML();
		return $config;
	}
}

?>