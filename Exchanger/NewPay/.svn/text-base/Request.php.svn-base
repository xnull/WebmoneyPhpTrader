<?php
/**
 * Класс создания новой заявки
 */
class Exchanger_NewPay_Request extends Exchanger_XmlRequest{
	
	/**
	 * Постанока новой заявки на биржу.
	 * @param Application_Composite $wmid
	 * @param str $inpurse номер кошелька ВМ-идентификатора wmid, с которого необходимо взять сумму к обмену для постановки заявки
	 * @param str $outpurse номер кошелька ВМ-идентификатора wmid, на который будут поступать средства по мере обмена
	 * @param double $inamount сумма, которая будет автоматически переведена с кошелька inpurse на кошелек сервиса секции wm.exchanger и выставлена к обмену
	 * @param double $outamount сумма, которую необходимо перевести на кошелек outpurse по завершению обмена
	 */
	public function __construct(Application_Composite $wmid, $inpurse, $outpurse, $inamount, $outamount){
		parent::__construct($wmid);
		$this->url = "https://wm.exchanger.ru/asp/XMLTrustPay.asp";
		
		$inamount = $this->trimToThreeCipher($inamount);
		$outamount = $this->trimToThreeCipher($outamount);
						
		$this->addRootParameter(new DOMElement("signstr", $this->signStr($wmid->getProperty("wmid") .$inpurse .$outpurse . $inamount . $outamount)));
		$this->addRootParameter(new DOMElement("inpurse", $inpurse));
		$this->addRootParameter(new DOMElement("outpurse", $outpurse));
		$this->addRootParameter(new DOMElement("inamount", $inamount));
		$this->addRootParameter(new DOMElement("outamount", $outamount));		
	}
	
	private function trimToThreeCipher($value){
		return Core_Double::trimToThreeCipher($value);
	}
}

?>