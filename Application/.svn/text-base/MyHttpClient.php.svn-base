<?php
class Application_MyHttpClient extends Application_HttpClient{
	/**
	 * @param unknown_type $url
	 * @return DOMDocument
	 */
	public function httpXmlGet($url){
		$httpClient = $this->getHttpClient();
		return $this->stringToXml($httpClient->fetch_url($url));
	}

	/**
	 * @param unknown_type $url
	 * @param unknown_type $postData
	 * @return DOMDocument
	 */
	public function httpXmlPost($url, $postData){
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
		$dom = new DOMDocument('1.0', 'Windows-1251');
		$dom->loadXML($string);
		return $dom;
	}

	function set_proxy_credentials($username, $password)
	{
		curl_setopt($this->ch, CURLOPT_PROXYUSERPWD, "$username:$password");
	}
}