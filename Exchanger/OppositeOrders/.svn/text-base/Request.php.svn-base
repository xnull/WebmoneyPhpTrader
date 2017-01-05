<?php

/**
 * Класс запроса списка противоположных заявок на бирже
 */
class Exchanger_OppositeOrders_Request extends Exchanger_XmlRequest{
	/**
	 * 
	 * @param Application_Composite $wmid
	 * @param unknown_type $bidtype
	 * @param unknown_type $queryid
	 */
	public function __construct(Application_Composite $wmid, $queryid = null){
		parent::__construct($wmid);
		$this->url = "https://wm.exchanger.ru/asp/XMLWMList3.asp";
		
		$this->addRootParameter(new DOMElement("signstr", $this->signStr($wmid->getProperty("wmid") .$queryid)));
		$this->addRootParameter(new DOMElement("type"));
		$this->addRootParameter(new DOMElement("queryid", $queryid));		
	}
}
