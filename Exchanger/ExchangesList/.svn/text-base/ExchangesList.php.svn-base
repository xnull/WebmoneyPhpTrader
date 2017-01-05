<?php
/**
 * Класс со списками всех направлений обменов, в конфиге!
 * WMZ, WMR, WME, WMU, WMB, WMG
 */
class Exchanger_ExchangesList_ExchangesList extends Core_Collections_HashMap {
	private $wmCurrencyes = array();
	/**
	 * Конфиг
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
	 * вернуть данные по имени направления обмена
	 * @param $direction направление обмена на бирже (WMZ_WMR например)
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
	 * вернуть данные по exchType
	 * @param $exchType направление обмена на бирже (1 например)
	 * @return Exchanger_ExchangesList_Exchange
	 */
	public function getExchangeByExchType($exchType){
		return $this->getExchange($this->getDirectionFromExchType($exchType));		
	}


	/**
	 * Получить для направления обмена соответствующее числовое значение (Например для WMZ_WMR = 1)
	 * @param String $direction направление обмена (например WMZ_WMR)
	 */
	public function getExchTypeFromDirection($direction){
		return $this->getExchange($direction)->getExchType();
	}

	/**
	 * Для exchType получить направление обмена, если такого направления обмена генерим исключение
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