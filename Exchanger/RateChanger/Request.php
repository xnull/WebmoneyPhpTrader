<?php

/**
 * Класс изменения курса моей заявки
 */
class Exchanger_RateChanger_Request extends Exchanger_XmlRequest{
	
	public function __construct(Application_Composite $wmid, $operid = null, $curstype, $cursamount){
		parent::__construct($wmid);
		$this->url = "https://wm.exchanger.ru/asp/XMLTransIzm.asp";
		
		$this->addRootParameter(new DOMElement("signstr", $this->signStr($wmid->getProperty("wmid") .$operid .$curstype .$cursamount)));
		$this->addRootParameter(new DOMElement("operid", $operid));
		$this->addRootParameter(new DOMElement("curstype", $curstype));		
		$this->addRootParameter(new DOMElement("cursamount", $cursamount));
	}
}
