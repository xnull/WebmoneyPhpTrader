<?php
class Core_Double {

	public static function toDouble($value){
		if (is_double($value)) {
			return $value;
		}
			
		try{
			if (is_string($value)) {
				$value = str_replace(',', '.', $value);
			}
			return  (double)$value;
		}
		catch (Exception $err){
			throw $err;
		}
	}

	public static function trimToThreeCipher($value){
		$trimm = ceil($value * 100) / 100;
		$trimm = Core_Double::toDouble($trimm);
		return $trimm;
	}
}