<?php

/**
 * ����� ��� ������ � ������������� ������� �� exchanger.ru
 */
class Exchanger_Direction{
	/**
	 * ��� ����� ������. "0" - ������ ���� (��������� ����� ������������ �� �����,
	 * � ����� ������� ���������� ��������),
	 * "1" - �������� ���� (��������� ����� ������� ���������� �������� � ����� ������������ �� �����)
	 * @var int
	 */
	const FORWARD = 0;
	const BACKWARD = 1;

	/**
	 * ������ ����������� ������� �� �����, ���������� � ��� �������.
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
	 * �������� �� ����������� ������($exchtype), ��� ����� ������ (0-������, 1-��������)
	 * @param $exchtype ����������� ������
	 * @return string ���� ������: 0 - ������, 1 - ��������
	 */
	public static function getCursType($exchtype) {
		$exchange = self::getExchange($exchtype);
		if ($exchange->getRateType() != "forward"){
			$exchtype =  self::getReverseExchType($exchtype);
		}

		if (!isset($exchtype)) {
			throw new Exception('exchType �� ���������������');
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