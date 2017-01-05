<?php
class Application_Request{
	private $get = array();
	private $post = array();

	public function Application_Request(){
		$this->get = $_GET;
		$this->post = $_POST;		
	}
	
	public function getParam($name){
		if ($this->getGetParam($name) != null ) {
			return $this->getGetParam($name);
		}
		return $this->getPostParam($name);
	}

	public function getGetParam($name){
		if (isset($this->get[$name])) {
			return $this->get[$name];
		} 
		return null;
	}

	public function getPostParam($name){
		if (isset($this->post[$name])) {
			return $this->post[$name];
		} 
		return null;
	}
}

?>