<?php
class Exchanger_OppositeOrders_List extends Exchanger_List{
	
	public function __construct(DOMDocument $xmlResponse){
		$this->concretePayType = 'Exchanger_OppositeOrders_Pay';
		parent::__construct($xmlResponse);
	}
}