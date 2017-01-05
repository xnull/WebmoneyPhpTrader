<?php
abstract class Exchanger_Factory{

	/**
	 * @param unknown_type $url
	 * @return DOMDocument
	 */
	protected function httpXmlGet($url){
		$httpClient = $this->getHttpClient();
		$result = $this->stringToXml($httpClient->fetch_url($url));
		return $result;
	}

	/**
	 * @param unknown_type $url
	 * @param unknown_type $postData
	 * @return DOMDocument
	 */
	protected function httpXmlPost($url, $postData){
		$httpClient = $this->getHttpClient();
		return $this->stringToXml($httpClient->send_post_data($url, $postData));
	}
	
	/**
	 * @return Application_HttpClient
	 */
	private function getHttpClient(){
		return Application_Registry::getHttpClient();
	} 

	private function stringToXml ($string){
		if ($string == null) {
			throw new Exception("Http client error. Не удалось получить данные из сети");
		}
		$dom = new DOMDocument('1.0', 'Windows-1251');
		$dom->loadXML($string);
		return $dom;
	}
}