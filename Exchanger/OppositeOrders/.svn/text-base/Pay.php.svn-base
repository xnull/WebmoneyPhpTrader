<?php
class Exchanger_OppositeOrders_Pay extends Exchanger_Pay{
	protected $isxid;

	function __construct(DOMElement $myPayXmlNode) {
		parent::__construct($myPayXmlNode);
	}

	public function getStateDescription(){
		return Exchanger_OppositeOrders_PayState::getStateDescription($this->state);
	}
}

?>