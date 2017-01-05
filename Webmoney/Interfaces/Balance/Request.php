<?php
/**
 * @filesource http://www.webmoney.ru/rus/developers/interfaces/xml/balance/index.shtml
 */
class Webmoney_Interfaces_Balance_Request extends Webmoney_XmlRequest{

	protected function initRootXmlElement(){
		$this->XmlRequestRootElement  = new DOMElement("w3s.request");
	}

	function __construct(Application_AbstractComposite $wmid, $destWmidNumber){
		$this->url = "https://w3s.webmoney.ru/asp/XMLPurses.asp";
		parent::__construct($wmid);		
		//todo reqn задать, надо ли?
		$reqN = null;
		
		$this->addRootParameter(new DOMElement("reqn", "1")); //$reqN));
		$this->addRootParameter(new DOMElement("wmid", $destWmidNumber));
		$this->addRootParameter(new DOMElement("sign", $this->signStr($destWmidNumber . "1"))); //$reqN)));
		
		$getpurses = new DOMElement('getpurses');
		$this->XmlRequestRootElement->appendChild($getpurses);
		
		$this->addNodeParameter($getpurses, new DOMElement("wmid", $destWmidNumber));
				
	}

}