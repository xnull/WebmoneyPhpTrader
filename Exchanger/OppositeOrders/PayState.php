<?php
class Exchanger_OppositeOrders_PayState{
	private static $states = array(
	0 => "������ ��� �� ��������",
	1 => "��������, � ����� �� ��� ����������, �� ������� �� ������� ��� �� ���������",
	2 => "�������� ��������� � ����������� ������� �� �������",
	3 => "����� �� ����������, ������ ���������� � ����� ������ ������� wmid (�� ������� ����, ��� ����� �� ������� ���������� �� �����-���� �� ������, ��������� ���� ����� ������ �� ������� ������������ �����, ��� � ����� ������ ��������� ������� ��� �������������� ���� ��������� ������)"
	);
	/**
	 * �������� �������� ������� ������
	 * @param int $value �� 1 �� 5
	 * @return str �������� �������
	 */
	public static function getStateDescription($value){
		return self::$states($value);
	}

}

?>