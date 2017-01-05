<?php

/**
 * Базовый абстрактный класс, содания хмл запросов.
 */
abstract class Webmoney_XmlRequest{
	/**
	 * 
	 * @var str урл адрес для посылки запроса 
	 */
	protected $url;
	/**
	 * Класс для шифрования строки ключом сертификата.
	 * @var WMSigner_WMSigner
	 */
	protected $WMSigner;
	/** 
	 * Xml документ запроса
	 * @var DOMDocument 
	 */
	protected $XmlRequest;
	/**
	 * Корневой элемент хмл документа - предствляющего собой хмл запрос
	 * @var DOMElement
	 */
	protected $XmlRequestRootElement;

	protected function __construct(Application_Composite $wmid){
		/**
		 * Завязали WMSigner_WMSigner на конфиг(Composite)! Подумать надо ли?
		 */
		$this->WMSigner = new wmsigner_WMSigner2($wmid->getProperty("wmid"), $wmid->getProperty("pass"), $wmid->getProperty("kwm"));

		$this->XmlRequest = new DOMDocument("1.0", "Windows-1251");
		$this->initRootXmlElement();
		$this->XmlRequest->appendChild($this->XmlRequestRootElement);
	}
	
	public function toString(){
		$result = $this->XmlRequest->saveXML();		
		return $result;
	}
	/**
	 * Инициализация корневого элемента, хмл запроса
	 * @abstract Инициализация корневого элемента, хмл запроса
	 */
	protected abstract function initRootXmlElement();

	protected function addRootParameter(DOMElement $XmlNodeParameter){
		$this->XmlRequestRootElement->appendChild($XmlNodeParameter);		
	}

	protected function addNodeParameter(DOMElement $node, DOMElement $XmlNodeParameter){
		$node->appendChild($XmlNodeParameter);		
	}
	
	/**
	 * Получить хмл документ запроса к серверу
	 * @return DOMDocument
	 */
	public function getXmlRequest(){
		return $this->XmlRequest;
	}
	
	public function getUrl(){
		return $this->url;
	}

	protected function signStr($plainStr){
		return $this->WMSigner->Sign($plainStr);
	}
}