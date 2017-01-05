<?php
class Webmoney_Comission{
	private static $maxComission = array('WMZ' => 50,
                               			 'WMR' => 1500, 
                               			 'WME' => 50, 
                               			 'WMU' => 250, 
                               			 'WMB' => 100000, 
                               			 'WMY' => 55000, 
                               			 'WMG' => 2);
	
	/**
	 * 
	 * @param double $summ
	 * @param string $wmCurrency ��� ������� ������ (WMZ, WMR)
	 */
	public static function getComission($wmCurrency, $summ){
		$summ = Core_Double::toDouble($summ);
		$comission = $summ * 0.008;
		$comission = self::checkMinComission($comission);
		$comission = self::checkMaxComission($wmCurrency, $comission);
		return $comission;
	}

	/**
	 * ��������, ���� �������� ���������, �� �������� ��������������,��������.
	 * ���� �������� ������ 0.1, �� ��������� �� ����� (�������� $comission = 0.085 ��������� �� 0.09)
	 * @param double $comission
	 * @return double
	 */
	public static function checkMinComission($comission){
		$comission = Core_Double::toDouble($comission);
		if ($comission < 0.1) {
			$comission = ceil($comission*100)/100;
			//���� �������� ������ 0.01, �� ��������� �� 0.01
			if ($comission < 0.01) {
				$comission = 0.01;
			}
		}
		return $comission;
	}
	
	public static function checkMaxComission($wmCurrency, $comission){
		if (!isset(self::$maxComission[$wmCurrency])) {
			throw new Exception('Webmoney currency:' . $wmCurrency . 'not found');
		}
		$maxComission = Core_Double::toDouble(self::$maxComission[$wmCurrency]);
		if ($comission > $maxComission) {
			return $maxComission;
		}
		return $comission;
	}
}

?>