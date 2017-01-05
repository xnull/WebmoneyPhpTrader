<?php
class Exchanger_ListMyPays_Factory extends Exchanger_Factory{

	/**
	 * @param Application_Composite $wmid
	 * @param unknown_type $bidtype
	 * @param unknown_type $queryid
	 * @return Exchanger_ListMyPays_ListMyPays
	 */
	public function getListMyPays(Application_Composite $wmid, $bidtype, $queryid = null){
		$request = new Exchanger_ListMyPays_Request($wmid, $bidtype, $queryid);
		$listMyPaysXmlDoc = $this->httpXmlPost($request->getUrl(), $request->toString());
		$listMyPays = $this->initListMyPays($listMyPaysXmlDoc);
		return $listMyPays;
	}

	/**
	 * @param DOMDocument $listMyPaysXmlDoc
	 * @return Exchanger_ListMyPays_ListMyPays
	 */
	private function initListMyPays(DOMDocument $listMyPaysXmlDoc){
		$listMyPays = new Exchanger_ListMyPays_ListMyPays();
		if (!$this->haveMyPays($listMyPaysXmlDoc)) {
			return  $listMyPays;
		}

		$listMyPays->setWmidNumber($this->getWmidNumber($listMyPaysXmlDoc));

		$xpath = new DOMXPath($listMyPaysXmlDoc);
		foreach ($xpath->query("//query") as $currentPay) {
			$myPay = $this->getPayFromXml($currentPay);
			$myPay->setWmidNumber($listMyPays->getWmidNumber());
			$myPay->setListMyPays($listMyPays);
			$listMyPays->addPay($myPay);
		}
		return $listMyPays;
	}

	private function haveMyPays(DOMDocument $listMyPaysXmlDoc){
		$result = new Exchanger_OperationResult($listMyPaysXmlDoc);
		if ($result->getRetval() == Exchanger_OperationResult::SUCCESS) {
			return true;
		}
		return false;
	}

	/**
	 * @param $xmlPay
	 * @return Exchanger_ListMyPays_MyPay
	 */
	private function getPayFromXml(DOMElement $xmlPay){
		$myPay = new Exchanger_ListMyPays_MyPay();
		foreach ($xmlPay->attributes as $xmlPayAttr) {
			$setMethod = 'set' . $xmlPayAttr->name;
			$myPay->$setMethod($xmlPayAttr->value);
		}
		return $myPay;
	}

	private function getWmidNumber(DOMDocument $listMyPaysXmlDoc){
		return $listMyPaysXmlDoc->getElementsByTagName("WMExchnagerQuerys")->item(0)->getAttribute('wmid');
	}
}