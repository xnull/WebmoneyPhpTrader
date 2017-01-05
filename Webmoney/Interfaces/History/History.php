<?php
/**
 * ������� �������� �� ��������.
 */
class Webmoney_Interfaces_History_History {
	/**
	 *
	 * @var Core_Collections_ArrayList
	 */
	private $operationsList;

	public function __construct() {
		$this->operationsList = new Core_Collections_ArrayList ();
	}

	/**
	 * ��������� ������� �� ��������
	 * @param $request Webmoney_History_Request
	 * @return Core_Collections_ArrayList
	 */
	public function getHistory(Webmoney_WMID_WMID $wmid, $purseNumber, $dateStart, $dateFinish) {
		//�������� ��������� ��������, �������� �������, ������������� � ���

		$hhtpclient = Application_Registry::getHttpClient ();
		$request = new Webmoney_Interfaces_History_Request ( $wmid->getWmidComposite (), $purseNumber, $dateStart, $dateFinish );
		$result = $hhtpclient->httpXmlPost ( $request->getUrl (), $request->getXmlRequest ()->saveXML () );

		$this->clearOperationsList();
		$this->fillOperationsListFromXml($result);
		return $this->operationsList;
	}

	/**
	 * ��������� ������� �� ��������
	 * @param $request Webmoney_History_Request
	 */
	public function getHistoryFromRequest(Webmoney_Interfaces_History_Request $request) {
		$hhtpclient = Application_Registry::getHttpClient ();		
		$result = $hhtpclient->httpXmlPost ( $request->getUrl (), $request->getXmlRequest ()->saveXML () );

		$this->clearOperationsList();
		$this->fillOperationsListFromXml($result);
	}
	
	/**
	 * 
	 * @return Core_Collections_ArrayList
	 */
	public function getOperationsList(){
		return $this->operationsList;
	}

	private function clearOperationsList(){
		$this->operationsList->clear();
	}

	private function fillOperationsListFromXml(DOMDocument $xmlHistory){
		$xpath = new DOMXPath($xmlHistory);
		$xmlOperations = $xpath->query("//operation");

		foreach ($xmlOperations as $xmlOperation) {
			$this->operationsList->add($this->createOperation($xmlOperation));
		}
	}

	private function createOperation(DOMElement $xmlOperation){
		$operation = new Webmoney_Interfaces_History_Operation();
		$operation->setId($xmlOperation->getAttribute("id"));

		foreach ($xmlOperation->childNodes	as $property) {
			//$property = new DOMElement();
			$setMethod = 'set' . $property->nodeName;
			$operation->$setMethod($property->nodeValue);
		}

		return $operation;
	}


}

?>