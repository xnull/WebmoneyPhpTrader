<?php

class Exchanger_ExchangesList_Exchange {
	/**
	 * @var OfficalRates_OfficalRates
	 */
	private $officalRates;
	
	/**
	 *
	 * @var Exchanger_OrderList_OrderList ������ ������ �� �����
	 */
	private $orderList;
	
	/**
	 * �������� Webmoney ������ (wmr ��������)
	 * @var str
	 */
	private $WMsource;
	
	private $WMDest;
	
	private $exchType;
	
	/**
	 *
	 * @var boolean ��������� ����: true - �������, false - ����������
	 */
	private $run;
	
	/**
	 * ��� �������� ������, ��� ������� ����������� ������ �� �����.
	 * �������� ��� WMZ_WMR(exchType=1), ����� ����� ���� �������, �� ���� USD/
	 * @var str
	 */
	private $realCurrencyName;
	
	private $maxSumm;
	private $minSumm;
	
	private $myPersent;
	private $bankName;
	private $dayLimit;
	private $rateType;
	
	/**
	 *
	 * @param Application_Composite $exchange
	 */
	public function __construct(Application_Composite $exchange) {
		$this->initExchangeSettings ( $exchange );
		$this->initSettings ( $exchange );
	}
	
	private function initExchangeSettings(Application_Composite $exchange) {
		$this->WMsource = $exchange->getProperty ( "WMsource" );
		$this->WMDest = $exchange->getProperty ( "WMdest" );
		$this->exchType = ( int ) $exchange->getProperty ( "exchType" );
		$this->realCurrencyName = $exchange->getChildNode ( "OfficalRates" )->getProperty ( "currencyName" );
		$this->bankName = $exchange->getChildNode ( "OfficalRates" )->getProperty ( "bank" );
	}
	
	private function initSettings(Application_Composite $exchange) {
		$this->dayLimit = Core_Double::toDouble ( $exchange->getChildNode ( "Settings" )->getProperty ( "dayLimit" ) );
		$this->maxSumm = Core_Double::toDouble ( $exchange->getChildNode ( "Settings" )->getProperty ( "maxSumm" ) );
		$this->minSumm = Core_Double::toDouble ( $exchange->getChildNode ( "Settings" )->getProperty ( "minSumm" ) );
		$this->run = $exchange->getChildNode ( "Settings" )->getProperty ( "run" );
		$this->myPersent = Core_Double::toDouble ( $exchange->getChildNode ( "Settings" )->getProperty ( "myPersent" ) );
		$this->rateType = $exchange->getProperty("rateType");
	}
	
	public function getRateType(){
		return $this->rateType;
	}
	
	public function getBankName() {
		return $this->bankName;
	}
	
	public function getDayLimit() {
		return $this->dayLimit;
	}
	
	/**
	 *
	 * @return Exchanger_OrderList_OrderList
	 */
	public function getOrderList() {
		return Application_Registry::getExchangerManager ()->getOrderList ( $this->exchType );
	}
	
	/**
	 *
	 * @return Exchanger_OrderList_Order
	 */
	public function getFirstOrder() {
		return $this->getOrderList ()->getFirstOrder ();
	}
	
	public function getMaxSumm() {
		return $this->maxSumm;
	}
	
	public function getMinSumm() {
		return $this->minSumm;
	}
	
	/**
	 * ��������� ���� - � ������ ��� ���.
	 * @var boolean ��������� ����.
	 * @return boolean true - �������, false - ����������
	 */
	public function getRun() {
		return $this->run;
	}
	
	/**
	 * �������� ��� �������� ������, ��� ������� ����������� ������ �� �����.
	 * �������� ��� WMZ_WMR(exchType=1), ����� ����� ���� �������, �� ���� USD
	 */
	public function getRealCurrencyName() {
		return $this->realCurrencyName;
	}
	
	public function getWMSurce() {
		return $this->WMsource;
	}
	
	public function getWMDest() {
		return $this->WMDest;
	}
	
	public function getExchType() {
		return $this->exchType;
	}
	
	public function getReverseExchType(){
		return Exchanger_Direction::getReverseExchType($this->exchType);
	}
	
	/**
	 * @return OfficalRates_OfficalRates
	 */
	public function getBank() {
		if (! isset ( $this->officalRates )) {
			$this->officalRates = Application_Registry::getBank ( $this->bankName );
		}
		return $this->officalRates;
	}
	
	public function getDirection() {
		return $this->WMsource . "_" . $this->WMDest;
	}
	
	public function getMyPersent() {
		return $this->myPersent;
	}
	
	public function getOfficalRate() {
		$rate = $this->getBank ()->getCurrency ( $this->getRealCurrencyName () )->getRate ();
		$nominal = $this->getBank ()->getCurrency ( $this->getRealCurrencyName () )->getNominal ();
		$result = Core_Double::toDouble ( $rate ) / Core_Double::toDouble ( $nominal );
		return $result;
	}
	
	/**
	 * �������� ����, ��� ������ �� �����������, ��������� �� ����� ������, � �������� ���������
	 */
	public function offRateplusMyPesent() {
		$persent = Core_Double::toDouble($this->getOfficalRate ()) * Core_Double::toDouble($this->getMyPersent ()) / 100;
		//$result = Exchanger_Calculator::plus ( $this->exchType, $this->getOfficalRate (), $persent );
		$result = $this->getOfficalRate () + $persent ;
		return $this->trimToThreeCipher ( $result );
	}
	
	private function trimToThreeCipher($value) {
		return ceil ( $value * 1000 ) / 1000;
	}
	
	/**
	 * �������� �� ����������� ������($exchtype), ��� ����� ������ (0-������, 1-��������)
	 * @param $exchtype ����������� ������
	 * @return string ���� ������: 0 - ������, 1 - ��������
	 */
	public function getCursType($exchtype) {
		return Exchanger_Direction::getCursType ( $exchtype );
	}
}

?>