<?php
class Webmoney_Interfaces_Balance{
	
	/**
	 * http://www.webmoney.ru/rus/developers/interfaces/xml/balance/index.shtml урл с описанием интерфейса
	 * @param Webmoney_WMID_WMID $wmid
	 * @param unknown_type $purseNumber
	 */
	public function get(Webmoney_WMID_WMID $wmid, $purseNumber){
		return 10000;
		//throw new Exception('поверить получение баланса');
		$request = new Webmoney_Interfaces_Balance_Request($wmid->getWmidComposite(), $wmid->getNumber());
		$httpClient = Application_Registry::getHttpClient();
		$xmlBalance = $httpClient->httpXmlPost($request->getUrl(), $request->toString());
		return $this->getPurseList($xmlBalance, $purseNumber);
	}

	public function getRealSumm(Webmoney_WMID_WMID $wmid, $purseNumber){
		$request = new Webmoney_Interfaces_Balance_Request($wmid->getWmidComposite(), $wmid->getNumber());
		$httpClient = Application_Registry::getHttpClient();
		$xmlBalance = $httpClient->httpXmlPost($request->getUrl(), $request->toString());
		return $xmlBalance;
		//return $this->getPurseList($xmlBalance, $purseNumber);
	}

	private function getPurseList(DOMDocument $xmlBalance, $purseNumber){
		foreach ($xmlBalance->getElementsByTagName('purse') as $xmlPurse) {
			$currentPurseNumber = $xmlPurse->getElementsByTagName('pursename')->item(0)->nodeValue;
			if ($currentPurseNumber == $purseNumber) {
				return $xmlPurse->getElementsByTagName('amount')->item(0)->nodeValue;
			}
		}
		return null;
	}
}