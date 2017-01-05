<?php
/**
 * ���� �������� ��������� ����, �� ������� ������ ������������ � �������� ������, �� ���� ���������� ������� �����.
 * ��� ��� ����� ������� �� �������, �� �������� ���� ����� ����� �� �������.
 * ����������� ��� � ���� (����� ����� �������� �� ���� ������, �������� �� ����?)
 */

class Cron_scripts_DayLimitChecker{

	public function run(){
		$this->dayLimit();
	}

	//���� ����� ����, �� ������� ��� ������ ������ ������ �������� ������
	private function dayLimit(){
		$dayLimitMapper = new ORM_DataMapper_Exchanger_ExchangesList_Limit();
		foreach ($dayLimitMapper->findAll()->iterator() as $dayLimit){
			$this->initDayLimit($dayLimitMapper, $dayLimit);
		}
	}

	public function initDayLimit(ORM_DataMapper_Exchanger_ExchangesList_Limit $dayLimitMapper, Exchanger_ExchangesList_limit $dayLimit){
		$dayLimit->setDate(Core_DateTime::getNowDate());
		$limitInConfig = $dayLimit->getDayLimitFromConfig($dayLimit->getExchType());
		$dayLimit->setDayLimit($limitInConfig);
		$dayLimit->setRemains($limitInConfig);		
		$dayLimitMapper->update($dayLimit);
	}
}
