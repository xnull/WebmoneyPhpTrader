<?php
class View_Base64_View extends View_View{

	protected function renderView(){
		include_once  View_View::getViewFolderPath() .'/Base64/Template.php';
	}
	
	public function encode(){
		return 'you';
	}
	
	public function getHistoryListHtmlTable(){		
		$historyList = $this->getVar('historyList');		
		
		$htmlTable= new HTML_Element('table');		
		foreach ($historyList->iterator() as $history) {			
			$htmlTR = new HTML_Element('tr');
			$htmlTR->addChild($this->getMyPayTD($history->getMyPay()));
			$htmlTR->addChild($this->getPurchasedOrderTD($history->getPurchasedOrder()));
			$htmlTable->addChild($htmlTR);
		}
		return $htmlTable->toString();
	}
	
	private function getMyPayTD(Exchanger_ListMyPays_MyPay $myPay){
		$td = new HTML_Element('td');
		$td->setBodyText('mypayId: ' . $myPay->getId());
		return $td;
	}
	
	private function getPurchasedOrderTD(Exchanger_OrderList_Order $purchasedOrder){
		$td = new HTML_Element('td');
		$td->setBodyText('purchasedOrderId: ' . $purchasedOrder->getId());
		return $td;
	}
}