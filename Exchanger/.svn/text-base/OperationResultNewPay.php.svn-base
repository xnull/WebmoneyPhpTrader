<?php
class Exchanger_OperationResultNewPay extends Application_DomainObject {
	/**
	 * @var Exchanger_OperationResult
	 */
	private $operationResult;
	private $operid;
	/**
	 * Идентификатор платежа в вебмани
	 * @var unknown_type
	 */
	private $wmtransid;
	
	public function init(DOMDocument $xmlResult) {
		if ($xmlResult == null) {
			return null;
		}
		$this->operationResult = new Exchanger_OperationResult ( $xmlResult );
		if ($this->operationResult->getRetval () != Exchanger_OperationResult::SUCCESS) {
			$operationMapper = new ORM_DataMapper_Exchanger_OperationResult ();
			$operationMapper->save ( $this->operationResult );
			return null;
		}
		$this->setXmlOperId ( $xmlResult );
		$this->setXmlWmtransid ( $xmlResult );
	}
	
	public function setXmlOperId(DOMDocument $xmlResult) {
		$this->operid = $xmlResult->getElementsByTagName ( 'retval' )->item ( 0 )->getAttribute ( 'operid' );
	}
	
	public function setXmlWmtransid(DOMDocument $xmlResult) {
		$this->wmtransid = $xmlResult->getElementsByTagName ( 'retval' )->item ( 0 )->getAttribute ( 'wmtransid' );
	}
	
	public function setOperId($value) {
		$this->operid = $value;
	}
	
	public function setWmtransid($value) {
		$this->wmtransid = $value;
	}
	
	public function getWmtransid() {
		return $this->wmtransid;
	}
	
	/**
	 * @return Exchanger_OperationResult
	 */
	public function getOperationResult() {
		return $this->operationResult;
	}
	
	public function getOperId() {
		return $this->operid;
	}
	
	public function getId() {
		return $this->getOperId ();
	}
	
	public function setId($id) {
		$this->operid = $id;
	}
}