<?php

/**
 * Класс запроса списка моих заявок на бирже
 */
class Exchanger_ListMyPays_Request extends Exchanger_XmlRequest{	
	/**
	 * 
	 * @param Application_Composite $wmid композитный класс вмид-а полученный из конфига.
	 * @param int $bidtype целое число - тип моей заявки на бирже которую хочу получить. @see BidType
	 * @param int $queryid id желаемой конкретной заявки (опционально)
	 */
	public function __construct(Application_Composite $wmid, $bidtype, $queryid = null){
		parent::__construct($wmid);
		$this->url = "https://wm.exchanger.ru/asp/XMLWMList2.asp";		
						
		$this->addRootParameter(new DOMElement("signstr", $this->signStr($wmid->getProperty("wmid") .$bidtype .$queryid)));
		$this->addRootParameter(new DOMElement("type", $bidtype));
		$this->addRootParameter(new DOMElement("queryid", $queryid));		
	}
	
}
