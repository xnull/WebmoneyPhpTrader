<?php

/**
 * Беларусь +. //BYR //WMB - белорусский рубль 
 */
class OfficalRates_NBRB extends OfficalRates_OfficalRates  {
		
	function __construct(){
		$this->url = "http://www.nbrb.by/Services/XmlExRates.aspx";
		$this->baseCurrencyName = "BYB"; 		
		parent::__construct();
	}		
}

?>