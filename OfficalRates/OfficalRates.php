<?php
/**
 * ����� ��� ���� ����� ����� ���������� � ������ ������������ ���� �����
 */
abstract class OfficalRates_OfficalRates extends Application_DomainObject{
	/**
	 * ��� ����� ����� ��
	 * @var str
	 */
	protected $url;
	
	protected $date;

	/**
	 * ��� ������� ������ (�������� ��� ��� ������� ������ ����� - WMR)
	 * @var str
	 */
	protected $WMBaseCurrency;
	/**
	 * ������ �����, � ����� �����
	 * @var OfficalRates_CurrencyList
	 */
	protected $currencyList;

	protected $baseCurrencyName;

	public function __construct() {
		$this->initCurrencyList();		
	}
	
	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		$this->date = $date;
	}
	
	public function getUrl(){
		return $this->url;
	}


	public function getBaseCurrencyName(){
		return $this->baseCurrencyName;
	}

	/**
	 * ��������� ������ �� � �����.
	 * @param str $charCode ��������� ��� ������ (USD ��������)
	 * @return OfficalRates_Currency
	 */
	public function getCurrency($charCode){
		return $this->currencyList->getCurrency($charCode);
	}

	/**
	 * @return OfficalRates_CurrencyList
	 */
	public function getCurrencyList(){
		if (!isset($this->currencyList)) {
			$this->initCurrencyList();
		}
		return $this->currencyList;
	}

	protected function initCurrencyList(){
		if (isset($this->currencyList)) {
			$this->currencyList->clearList();
			return;
		}
		$this->currencyList = new OfficalRates_CurrencyList();
	}

	public function getCurrencyRate($currencyCharCode){
		$currency = $this->getCurrency($currencyCharCode);
		$rate = Core_Double::toDouble($currency->getRate()) / $currency->getNominal();
		return $rate;
	}
}

?>