<?php
class Exchanger_OrderList_Factory extends Exchanger_Factory {
	
	/**
	 * @return Exchanger_OrderList_OrderList
	 */
	public function get($exchType) {		
		$orderList = new Exchanger_OrderList_OrderList ( $exchType );
		try {
			$xmlOrderList = $this->httpXmlGet ( $orderList->getQueryUrl () );
			$orderList->setOfficalRateInExchanger($this->getOffRateFromXmlFile($xmlOrderList));
			$this->getOrderListFromXml ( $xmlOrderList, $orderList );
		} catch ( Exception $err ) {
			throw new Exception("Ошибка при создании OrderList, exchType: " . $exchType);
		}		
		return $orderList;
	}
	
	private function getOffRateFromXmlFile(DOMDocument $doc){
		return $doc->getElementsByTagName("BankRate")->item(0)->nodeValue;
	}
	
	private function getOrderListFromXml(DOMDocument $xmlOrderList, Exchanger_OrderList_OrderList $orderList) {
		$xmlOrders = $xmlOrderList->getElementsByTagName ( "query" );
		foreach ( $xmlOrders as $xmlOrder ) {
			$orderList->add ( $this->getOrderFromXml ( $xmlOrder, $orderList->getExchType () ) );
		}
	}
	
	private function getOrderFromXml(DOMElement $xmlOrder, $exchType) {
		$order = new Exchanger_OrderList_Order ();
		$order->setExchType ( $exchType );
		foreach ( $xmlOrder->attributes as $xmlPayAttr ) {
			$setMethod = 'set' . $xmlPayAttr->name;
			$order->$setMethod ( $xmlPayAttr->value );
		}
		return $order;
	}
}