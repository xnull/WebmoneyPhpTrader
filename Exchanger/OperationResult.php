<?php
/**
 * Парсер результата операции, запрошенной для выполнения на эксченджере
 */
class Exchanger_OperationResult extends Application_DomainObject {
	/**
	 * -20 - По указанным критериям выставленных заявок у идентификатора 384986898423 нет
	 * -10 - Подпись не прошла. Строка для подписи 384986898423Z413138348810R11442316516210308.053
	 */
	const SUCCESS = '0';
	
	private $retval;
	private $retdesc;
	private $date;
	
	public function __construct(DOMDocument $xmlResult = null) {
		if ($xmlResult == null) {
			return;
		}
		$this->initFromXmldDoc ( $xmlResult );
	}
	
	private function initFromXmldDoc(DOMDocument $xmlResult) {
		$xpath = new DOMXPath ( $xmlResult );
		
		$this->retval = $xpath->query ( "//retval" )->item ( 0 )->nodeValue;
		$this->retdesc = iconv('UTF-8', 'windows-1251', (String) $xpath->query("//retdesc")->item(0)->nodeValue); //$xpath->query ( "//retdesc" )->item ( 0 )->nodeValue;  	
	}
	
	public function setDate($date) {
		$this->date = Core_DateTime::toDateTime ( $date );
	}
	
	public function getDate() {
		return Core_DateTime::toDateTime ( $this->date );
	}
	
	public function getRetval() {
		return $this->retval;
	}
	
	public function getRetdesc() {
		return $this->retdesc;
	}
	/**
	 * @param $retval the $retval to set
	 */
	public function setRetval($retval) {
		$this->retval = $retval;
	}
	
	/**
	 * @param $retdesc the $retdesc to set
	 */
	public function setRetdesc($retdesc) {
		$this->retdesc = $retdesc;
	}

}

?>