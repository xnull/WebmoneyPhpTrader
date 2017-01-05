<?php

/**
 * Класс запроса списка моих заявок на бирже
 */
class Exchanger_OrdersUnion_Request extends Exchanger_XmlRequest{
	
	/**
	 * 
	 * @param Application_Composite $wmid
	 * @param unknown_type $operid номер, выставленной идентификатором wmid, новой заявки, к которой необходимо присоединить заявку unionoperid
	 * @param unknown_type $unionoperid номер, выставленной идентификатором wmid, новой заявки, которую необходимо присоединить к заявке operid, при этом обе суммы к обмену будут объеденены и курс получившейся заявки operid останется прежним
	 */
	public function __construct(Application_Composite $wmid, $operid, $unionoperid){
		parent::__construct($wmid);
		$this->url = "https://wm.exchanger.ru/asp/XMLTransUnion.asp";
		
		$this->addRootParameter(new DOMElement("signstr", $this->signStr($wmid->getProperty("wmid") .$operid .$unionoperid)));
		$this->addRootParameter(new DOMElement("operid", $operid));
		$this->addRootParameter(new DOMElement("unionoperid", $unionoperid));		
	}
}
