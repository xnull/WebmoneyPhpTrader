<?php
//Ќа будущее - складывать нужно всЄ таки валюты а не числа
class Exchanger_Calculator{

	/**
	 *
	 * @param integer $exchType направление обмена
	 * @param double $currencyRate курс валюты
	 * @param double $value добавл€емое значение
	 * @return double »тоговое значение курс валюты плюс значение
	 */
	public static function plus($exchType, $currencyRate, $value){
		$currencyRate = Core_Double::toDouble($currencyRate);
		$value = Core_Double::toDouble($value);
		
		if (Exchanger_Direction::getCursType($exchType) == Exchanger_Direction::FORWARD ) {
			return $currencyRate - $value;
		}
		else {
			return $currencyRate + $value;
		}
	}
	
	public static function multiplication($exchType, $summForExch, $rate){
		$result = null;
		if (Exchanger_Direction::getCursType($exchType) == Exchanger_Direction::FORWARD) {
			$result = Core_Double::toDouble($summForExch) / Core_Double::toDouble($rate);
		}
		else {
			$result = Core_Double::toDouble($summForExch) * Core_Double::toDouble($rate);
		}
		return $result;
	}

	/**
	 * 
	 * @param integer $exchType направление обмена
	 * @param double $comparedValue сравниваемое значение 
	 * @param double $value значение с которым сравниваем 
	 * @return double
	 * туду -  переименовать в greaterThanOrEqual
	 */
	public static function largerThanOrEqual($exchType, $comparedValue, $value){
		$comparedValue = Core_Double::toDouble($comparedValue);
		$value = Core_Double::toDouble($value);
		
		if (Exchanger_Direction::getCursType($exchType) == Exchanger_Direction::FORWARD) {
			if ($comparedValue <= $value) {
				return true;
			}
			else{
				return false;
			}
		}
		else {
			if ($comparedValue >= $value) {
				return true;
			}
			else{
				return false;
			}
		}
	}
}




























