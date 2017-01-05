<?php
class OrderList_OLD extends Core_Collections_HashMap{
	const URL = "https://wm.exchanger.ru/asp/XMLWMList.asp";
	private $wmidNumber;
	private $exchType;

	/**
	 *
	 * @var DOMDocument
	 */
	private $xmlOrderList;

	/**
	 * Список заявок на бирже
	 * @param int $exchType направление обмена
	 */
	public function __construct(DOMDocument $xmlOrderList, $exchType){
		$this->xmlOrderList = $xmlOrderList;
		$this->parse();
		$this->setWmidNumber();
		$this->exchType = (int)$exchType;		
	}

	public static function getQueryUrl($exchType){
		return self::URL ."?exchtype=" . $exchType;
	}

	public function getExchType(){
		return $this->exchType;
	}

	private function parse(){
		$orders = $this->xmlOrderList->getElementsByTagName("query");
		foreach ($orders as $currentXmlOrder) {
			$this->add($currentXmlOrder->attributes->item(0)->value, new Exchanger_OrderList_Order($currentXmlOrder, $this));
		}
	}

	private function setWmidNumber(){
		$xpath = new DOMXPath($this->xmlOrderList);
		$this->wmidNumber = $xpath->query("//WMExchnagerQuerys")->item(0)->attributes->item(0)->value;
	}

	/**
	 * @return Exchanger_OrderList_Order
	 */
	public function getOrder($orderId){
		return $this->getValue($orderId);
	}

	/**
	 *
	 * @return Exchanger_OrderList_Order
	 */
	public function getFirstOrder(){
		return $this->getIterator()->rewind()->current();
	}
	
	public function getWmidNumber(){
		return $this->wmidNumber;
	}
}

?>