<?php

/**
 * Узбекистан +. средства эквивалентные узбекский Сум - WMY 
 */
class OfficalRates_CBU extends OfficalRates_OfficalRates{
		
	public function __construct(){
		$this->url = "http://informer.uzreport.com/xml_valuta.fgi?lan=r";
		$this->baseCurrencyName = "UZS";		
		parent::__construct();
	}
}

?>