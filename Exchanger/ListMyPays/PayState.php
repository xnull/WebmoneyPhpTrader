<?php
class Exchanger_ListMyPays_PayState{
	/**
	 * ѕолучить описание статуса за€вки
	 * @param int $value от 1 до 5
	 * @return str ќписание статуса
	 */
	public static function getStateDescription($value){
		$states = array(0 => "за€вка еще не оплачена",
							1 => "оплачена, идет обмен",
							2 => "погашена полностью",
							3 => "объединена с другой новой",
							4 => "удалена, средства не возвращены",
							5 => "удалена, средства возвращены ");
							
		return $states[$value];
	}
	
}

?>