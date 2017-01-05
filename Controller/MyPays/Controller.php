<?php
class Controller_MyPays_Controller extends Controller_Controller{

	public function index(){
		$exchManager = Application_Registry::getExchangerManager();
		$wmidNumber = $this->request->getGetParam("wmid");
		if ($wmidNumber != null){
			$wmid = $this->getWmidComposite($wmidNumber);
		}
		else{
			$wmid = $this->getFirstWmidComposite();
		}		

		$listMyPays = $exchManager->getListMyPays($wmid, Exchanger_ListMyPays_BidType::ALLTYPES);
		$this->view->add("listMyPays" ,$listMyPays);
		$this->view->display();
	}

	private function getWmidComposite($wmidNumber){
		$wmidFactory = new Webmoney_WMID_WMIDFactory();
		$wmid = $wmidFactory->getWmidList()->getWmidByNumber($wmidNumber);
		return $wmid->getWmidComposite();
	}

	private function getFirstWmidComposite(){
		$wmidFactory = new Webmoney_WMID_WMIDFactory();
		$wmid = $wmidFactory->getWmidList()->get(0);
		return $wmid->getWmidComposite();
	}
}