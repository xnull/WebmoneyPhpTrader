<?php
/**
 * ≈сли наступил следующий день, то остаток обмена приравниваем к дневному лимиту, то есть сбрасываем дневной лимит.
 * “ак как лимит беретс€ из конфига, то наверное надо брать лимит из конфига.
 * «апускаетс€ раз в день (может тогда проверку не надо делать, сменилс€ ли день?)
 */

class Cron_scripts_DayLimitChecker{

	public function run(){
		$this->dayLimit();
	}

	//если новый день, то остаток дл€ обмена делаем равным дневному лимиту
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
