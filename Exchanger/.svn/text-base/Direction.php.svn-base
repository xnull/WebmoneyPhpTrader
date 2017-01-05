<?php

/**
 * Класс для работы с направлениями обменов на exchanger.ru
 */
class Exchanger_Direction{
	/**
	 * Тип курса обмена. "0" - прямой курс (отношение суммы выставленной на обмен,
	 * к сумме которую необходимо получить),
	 * "1" - обратный курс (отношение суммы которую необходимо получить к сумме выставленной на обмен)
	 * @var int
	 */
	const FORWARD = 0;
	const BACKWARD = 1;

	/**
	 * Список направлений обменов на бирже, хранящийся в хмл конфиге.
	 * @var Exchanger_ExchangesList_ExchangesList
	 */
	private $exchangesList;

	public static function getReverseExchType($exchType) {
		$exchType = (int)$exchType;
		if ($exchType % 2 == 0 ) {
			return --$exchType;
		}
		else {
			return ++$exchType;
		}
	}

	public static function getReverseDirection($direction) {
		if (strlen($direction) == 7) {
			$InPurse = substr($direction, 0, 3);
			$OutPurse = substr($direction, 4, 3);
			$Direction= $OutPurse . "_" . $InPurse;
			return $Direction;
		}
		return null;
	}

	public static function getWMDestFromDirection($direction) {
		if (strlen($direction) == 7) {			
			$OutPurse = substr($direction, 4, 3);
			return $OutPurse;
		}
		return null;
	}

	public static function getWMSourceFromDirection($direction) {
		if (strlen($direction) == 7) {
			$InPurse = substr($direction, 0, 3);
			return $InPurse;
		}
		return null;
	}

	/**
	 * Получить из направления обмена($exchtype), тип курса обмена (0-прямой, 1-обратный)
	 * @param $exchtype направления обмена
	 * @return string курс обмена: 0 - прямой, 1 - обратный
	 */
	public static function getCursType($exchtype) {
		$exchange = self::getExchange($exchtype);
		if ($exchange->getRateType() != "forward"){
			$exchtype =  self::getReverseExchType($exchtype);
		}

		if (!isset($exchtype)) {
			throw new Exception('exchType не инициализирован');
		}

		if ($exchtype % 2 == 0){
			return self::FORWARD;
		}
		else{
			return self::BACKWARD;
		}
	}

	private static function getExchange($exchType){
		$exchList = Application_Registry::getExchangerManager()->getExchangesList();
		return $exchList->getExchangeByExchType($exchType);
	}

}