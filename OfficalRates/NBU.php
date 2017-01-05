<?php

/*
 * Национальный банк Украины +. Гривны - WMU 
 */
class OfficalRates_NBU extends OfficalRates_OfficalRates  {
	
	function __construct(){
		$this->url = "http://bank-ua.com/export/currrate.xml";
		$this->baseCurrencyName = "UAH"; //WMU 
		$this->valuteXmlTagName = 'item';
		parent::__construct();
	}	
}

?>