<?php
/**
 * Ѕазовый класс дл€ создани€ хмл запросов серверу exchanger.ru 
 */
class Exchanger_XmlRequest extends Webmoney_XmlRequest{
	/**
	 * 
	 * @param $wmid объект WMID (из конфига) представл€ющий из себ€ класс Composite 
	 */
	function __construct(Application_AbstractComposite $wmid){
		parent::__construct($wmid);
		$this->addRootParameter(new DOMElement("wmid", $wmid->getProperty("wmid")));
	}
	
	/**
	 * »нициализаци€ корневого элемента, хмл запроса
	 */
	protected function initRootXmlElement(){
		$this->XmlRequestRootElement  = new DOMElement("wm.exchanger.request");
	}	
}

?>