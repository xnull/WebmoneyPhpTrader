<?php
class Exchanger_ListMyPays_PayState{
	/**
	 * �������� �������� ������� ������
	 * @param int $value �� 1 �� 5
	 * @return str �������� �������
	 */
	public static function getStateDescription($value){
		$states = array(0 => "������ ��� �� ��������",
							1 => "��������, ���� �����",
							2 => "�������� ���������",
							3 => "���������� � ������ �����",
							4 => "�������, �������� �� ����������",
							5 => "�������, �������� ���������� ");
							
		return $states[$value];
	}
	
}

?>