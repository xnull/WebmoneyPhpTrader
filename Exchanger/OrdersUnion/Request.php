<?php

/**
 * ����� ������� ������ ���� ������ �� �����
 */
class Exchanger_OrdersUnion_Request extends Exchanger_XmlRequest{
	
	/**
	 * 
	 * @param Application_Composite $wmid
	 * @param unknown_type $operid �����, ������������ ��������������� wmid, ����� ������, � ������� ���������� ������������ ������ unionoperid
	 * @param unknown_type $unionoperid �����, ������������ ��������������� wmid, ����� ������, ������� ���������� ������������ � ������ operid, ��� ���� ��� ����� � ������ ����� ���������� � ���� ������������ ������ operid ��������� �������
	 */
	public function __construct(Application_Composite $wmid, $operid, $unionoperid){
		parent::__construct($wmid);
		$this->url = "https://wm.exchanger.ru/asp/XMLTransUnion.asp";
		
		$this->addRootParameter(new DOMElement("signstr", $this->signStr($wmid->getProperty("wmid") .$operid .$unionoperid)));
		$this->addRootParameter(new DOMElement("operid", $operid));
		$this->addRootParameter(new DOMElement("unionoperid", $unionoperid));		
	}
}
