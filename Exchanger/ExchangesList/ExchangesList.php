<?php
/**
 * ����� �� �������� ���� ����������� �������, � �������!
 * WMZ, WMR, WME, WMU, WMB, WMG
 */
class Exchanger_ExchangesList_ExchangesList extends Core_Collections_HashMap {
	private $wmCurrencyes = array();
	/**
	 * ������
	 * @var Configs_Config
	 */
	private $config;

	public function __construct(){
		$this->config = Application_Registry::getConfig();

		$this->initExchanges();
		$this->initWMCurrencyes();
	}

	private function initExchanges(){
		foreach ($this->config->getChildNode("Exchanges")->getNodeIterator() as $currentExchange) {
			$exch = new Exchanger_ExchangesList_Exchange($currentExchange);
			$this->add($exch->getDirection(), $exch);
		}
	}

	private function initWMCurrencyes(){
		foreach ($this->config->getChildNode("Exchanges")->getPropertiesIterator() as $wmCurrency) {
			$this->wmCurrencyes[] = $wmCurrency;
		}
	}

	/**
	 * ������� ������ �� ����� ����������� ������
	 * @param $direction ����������� ������ �� ����� (WMZ_WMR ��������)
	 * @return Exchanger_ExchangesList_Exchange
	 */
	public function getExchange($direction){
		try{
			return $this->getValue($direction);
		}
		catch(Exception $err){
			throw new Exception('direction ' . $direction . 'not found');
		}
	}

	/**
	 * ������� ������ �� exchType
	 * @param $exchType ����������� ������ �� ����� (1 ��������)
	 * @return Exchanger_ExchangesList_Exchange
	 */
	public function getExchangeByExchType($exchType){
		return $this->getExchange($this->getDirectionFromExchType($exchType));		
	}


	/**
	 * �������� ��� ����������� ������ ��������������� �������� �������� (�������� ��� WMZ_WMR = 1)
	 * @param String $direction ����������� ������ (�������� WMZ_WMR)
	 */
	public function getExchTypeFromDirection($direction){
		return $this->getExchange($direction)->getExchType();
	}

	/**
	 * ��� exchType �������� ����������� ������, ���� ������ ����������� ������ ������� ����������
	 * @param int $exchType
	 */
	public function getDirectionFromExchType($exchType){
		foreach ($this->getIterator() as $currentDirection) {
			if ($currentDirection->getExchType() == $exchType) {
				return $currentDirection->getDirection();
			}
		}
		throw new Exception('exchType ' . $exchType . ' not found');
	}


}
?>