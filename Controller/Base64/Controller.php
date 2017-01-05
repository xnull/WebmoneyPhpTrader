<?php
class Controller_Base64_Controller extends Controller_Controller{
	
	public function index(){		
		$this->view->display();
	}	
	
	public function encode(){
		$this->setView('View_Base64_Encode');
		$keyFile =  file_get_contents($_FILES['keyFile']['tmp_name']);
		$encodeStr = WMSigner_WMSigner::base64Encode($keyFile);
		$this->view->add('encode', $encodeStr);
		$this->view->display();
	}
}