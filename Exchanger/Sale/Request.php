<?php

/**
 * Класс запрос на покупку противоположной валюты
 */
class Exchanger_Sale_Request extends Exchanger_XmlRequest{
	
	/**
	 * 
	 * @param Application_Composite $wmid
	 * @param int $isxtrid номер, выставленной идентификатором wmid, новой заявки, c которой будет производится покупка чужой заявки номер desttrid
	 * @param int $desttrid номер чужой заявки, которую необходимо купить
	 * @param datetime $deststamp число равное сумме часа, минуты и секунды из даты заявки, которую необходимо купить (querydate в интерфейсе 2), в случае если заявка, которую необходимо купить - изменялась и у нее будет другое время (другая сумма часа минуты и секунды), траназкция не пройдет. Для совместимости в данном параметре можно ничего не передавать или передавать число 1001, в этом случае проверка на измененность заявки производиться не будет.
	 */
	public function __construct(Application_Composite $wmid, $isxtrid, $desttrid, $deststamp = null){
		parent::__construct($wmid);
		$this->url = "https://wm.exchanger.ru/asp/XMLQrFromTrIns.asp";
		
		$this->addRootParameter(new DOMElement("signstr", $this->signStr($wmid->getProperty("wmid") .$isxtrid .$desttrid .$deststamp)));
		$this->addRootParameter(new DOMElement("isxtrid", $isxtrid));
		$this->addRootParameter(new DOMElement("desttrid", $desttrid));		
		$this->addRootParameter(new DOMElement("deststamp", $deststamp));
	}
	
	
}
