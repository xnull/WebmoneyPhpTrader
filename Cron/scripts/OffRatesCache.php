<?php
/**
 * Сохранение курсов ЦБ в кэш. Запуск раз в 5 минут.
 */
include_once '../../Core/Loader.php';

class Cron_scripts_OffRatesCache{

	public function run(){
		$this->cacheOffRates();
	}


	public function cacheOffRates(){
		$offRatesFactory = new OfficalRates_OfficalRatesFactory();
		$offRatesFactory->refreshOfficalRatesCash();
	}

}