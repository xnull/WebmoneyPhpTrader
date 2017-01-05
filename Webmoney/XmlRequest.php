<?php

/**
 * ������� ����������� �����, ������� ��� ��������.
 */
abstract class Webmoney_XmlRequest{
	/**
	 * 
	 * @var str ��� ����� ��� ������� ������� 
	 */
	protected $url;
	/**
	 * ����� ��� ���������� ������ ������ �����������.
	 * @var WMSigner_WMSigner
	 */
	protected $WMSigner;
	/** 
	 * Xml �������� �������
	 * @var DOMDocument 
	 */
	protected $XmlRequest;
	/**
	 * �������� ������� ��� ��������� - �������������� ����� ��� ������
	 * @var DOMElement
	 */
	protected $XmlRequestRootElement;

	protected function __construct(Application_Composite $wmid){
		/**
		 * �������� WMSigner_WMSigner �� ������(Composite)! �������� ���� ��?
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
	 * ������������� ��������� ��������, ��� �������
	 * @abstract ������������� ��������� ��������, ��� �������
	 */
	protected abstract function initRootXmlElement();

	protected function addRootParameter(DOMElement $XmlNodeParameter){
		$this->XmlRequestRootElement->appendChild($XmlNodeParameter);		
	}

	protected function addNodeParameter(DOMElement $node, DOMElement $XmlNodeParameter){
		$node->appendChild($XmlNodeParameter);		
	}
	
	/**
	 * �������� ��� �������� ������� � �������
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