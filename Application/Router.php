<?php
class Application_Router{
	/**
	 * @var Controller_Controller
	 */
	private $controller;
	/**
	 * @var Application_Request
	 */
	private $request;

	private $action;

	public function Application_Router(Application_Request $request){
		$this->request = $request;

		$this->initController();
		$this->initAction();
	}

	private function initController(){
		$controllerName = $this->getControllerName();

		if ($this->controllerExist($controllerName)) {
			$controllerName = "Controller_" .$controllerName . "_Controller";
		}
		else {
			$controllerName = "Controller_Main_Controller";
		}

		try{
			$this->controller = new $controllerName($this->request);
		}
		catch (Exception $err){
			$this->controller = new Controller_Main_Controller();
		}

	}

	private function getControllerName(){
		$controllerName = ucfirst($this->request->getParam("page"));

		if(empty($controllerName))
		{
			$controllerName = 'Main';
		}
		return $controllerName;
	}

	private function controllerExist($controllerName){
		$exsist = file_exists(Core_Loader::getRootDir() ."/Controller/" .$controllerName ."/Controller.php");
		return $exsist;
	}

	private function initAction(){
		$this->action = $this->request->getParam("action");
		if (!isset($this->action)) {
			$this->action = "index";
		}
	}

	public function runController(){		
		$action = $this->action;
		if (is_callable(array($this->controller, $action))) {
			$this->controller->$action();
		}
		else {
			$this->controller->index();
		}
	}

	public function getController(){
		if (isset($this->controller)) {
			return $this->controller;
		}
		die ("Неправильный вызов");
	}
}
?>