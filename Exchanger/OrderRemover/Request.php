<?php

/**
 * Класс запроса списка моих заявок на бирже
 */
class Exchanger_OrderRemover_Request extends Exchanger_XmlRequest{
	
	
	public function __construct(Application_Composite $wmid, $operid = null){
		parent::__construct($wmid);
		$this->url = "https://wm.exchanger.ru/asp/XMLTransDel.asp";
		
		$this->addRootParameter(new DOMElement("signstr", $this->signStr($wmid->getProperty("wmid") .$operid)));
		$this->addRootParameter(new DOMElement("operid", $operid));
	}
}
