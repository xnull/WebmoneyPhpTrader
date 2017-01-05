<?php

/**
 * ����� ��� ������� �� ��������� ������� �������� �� ��������.
 */
class Webmoney_Interfaces_History_Request extends Webmoney_XmlRequest{ 
	/**
	 * 
	 * @var DOMElement
	 */
	private $getOperations;
	
	/**
	 * 
	 * @param $wmid ����������� ������ ���� �� �������
	 * @param $purseNumber ����� �������� �� �������� ���������� �������� �������
	 * @param $dateStart ��������� ���� (� ������� Ymd hh:mm:ss - ����� �� ����� ��������)
	 * @param $dateFinish �������� ���� (� ������� Ymd hh:mm:ss - ����� �� ����� ��������)
	 */
	function __construct(Application_Composite $wmid, $purseNumber, $dateStart, $dateFinish){
		parent::__construct($wmid);		
		
		$this->url = "https://w3s.webmoney.ru/asp/XMLOperations.asp";
		
		$this->addRootParameter(new DOMElement("wmid", $wmid->getProperty("wmid")));
		$this->addRootParameter(new DOMElement("reqn", "1"));
		$this->addRootParameter(new DOMElement("sign", $this->signStr($purseNumber ."1")));
		
		$getOperations = new DOMElement("getoperations");
		$this->getOperations = $getOperations;				
		$this->addRootParameter($getOperations);
		
		$this->addNodeParameter($getOperations, new DOMElement("purse", $purseNumber));
		$this->addNodeParameter($getOperations, new DOMElement("datestart", $dateStart));
		$this->addNodeParameter($getOperations, new DOMElement("datefinish", $dateFinish));

		
	}
	
	public function setWmtranid($wmtranid){
		$this->addNodeParameter($this->getOperations, new DOMElement("wmtranid", $wmtranid));
	}
	
	/**
	 * ������������� ��������� ��������, ��� �������
	 */
	protected function initRootXmlElement(){
		$this->XmlRequestRootElement  = new DOMElement("w3s.request");
	}
}

?>