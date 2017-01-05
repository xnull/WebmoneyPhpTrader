<?php
class Controller_History_Controller extends Controller_Controller{
	
	public function index(){
		//получить с базы хистори, и распендюрить его. Хистори будет списком - надо финдалл делать метод
		$historyMapper = new ORM_DataMapper_Exchanger_History();
		$historyList = $historyMapper->findAll();
		$this->view->add("historyList" ,$historyList);
		$this->view->display();
	}	
}