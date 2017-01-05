<?php
class OfficalRates_OfficalRatesFactory{

	/**
	 * ПРоходим по всем напрвлениям обменов и сохраняем в кэш все полученные оф. курсы валют
	 * По идее этот метод нужно вызввать в кроне, раз в 5 мин
	 */
	public function refreshOfficalRatesCash() {
		$bankNames = array();
		$exchManager = Application_Registry::getExchangerManager();
		$exchList = $exchManager->getExchangesList();
		foreach ($exchList->getIterator() as $exch) {
			//$exch = new Exchanger_ExchangesList_Exchange();
			if (isset($bankNames[$exch->getBankName()])) {
				continue;
			}
			try{
				$this->saveOffRateToCash($exch);
				$bankNames[$exch->getBankName()] = 'loaded';
			}
			catch (Exception $err){
				$log = new Log_Log();
				$log->setDate(Log_Log::getNowDate());
				$log->setMessage('Не удалось получить курсы с сайта ЦБ: ' . $exch->getBankName());
				$logMapper = new ORM_DataMapper_Log_Log();
				$logMapper->save($log);
			}
		}
	}

	private function saveOffRateToCash(Exchanger_ExchangesList_Exchange $exch) {
		$url = $this->getBank($exch->getBankName())->getUrl();
		$xmlDoc = $this->httpXmlGet($url);
		$xmlDoc->save(Core_Loader::getRootDir() . '/Cache/Data/' . $exch->getBankName() . '.xml');
	}

	/**
	 * @return OfficalRates_OfficalRates
	 */
	private function getBank($bankName){
		$bankClass = 'OfficalRates_' . $bankName;
		return new $bankClass();
	}

	/**
	 * @return OfficalRates_CBR
	 */
	public function getCBR(){
		$cbr = new OfficalRates_CBR();
		$valuteTag = 'Valute';

		$docFromCache = $this->getOffRateXmlFromCache('CBR');
		if (!$docFromCache->hasChildNodes()) {
			return $cbr;
		}

		$date = $docFromCache->getElementsByTagName('ValCurs')->item(0)->getAttribute('Date');
		$date = Core_DateTime::toDateTime($date);
		$cbr->setDate($date);

		if (!$this->ratesIsActual($date)){
			$docFromCache = $this->getOffRateXmlFromCache('CBR');
		}

		$currencyList = $this->getCurrencyList($docFromCache, $valuteTag);
		$this->fillCurrencyListFromXml($cbr, $currencyList, 'NumCode', "CharCode", "Nominal", "Value", "Name");
		return $cbr;
	}
	
	/**
	 * @return OfficalRates_Exchanger
	 */
	public function getExchanger(){
		$exchanger = new OfficalRates_Exchanger();
		return $exchanger;
	}

	/**
	 * @return OfficalRates_CBU
	 */
	public function getEURUSD(){
		$eurusd = new OfficalRates_EURUSD();

		$docFromCache = $this->getOffRateXmlFromCache('CBR');
		$date = $docFromCache->getElementsByTagName('ValCurs')->item(0)->getAttribute('Date');
		$date = Core_DateTime::toDateTime($date);
		$eurusd->setDate($date);

		if (!$this->ratesIsActual($date)){
			$docFromCache = $this->getOffRateXmlFromCache('CBR');
		}

		return $eurusd;
	}

	/**
	 * @return OfficalRates_CBU
	 */
	public function getCBU(){
		$cbu = new OfficalRates_CBU();
		$valuteTag = 'block';

		$docFromCache = $this->getOffRateXmlFromCache('CBU');
		if (!$docFromCache->hasChildNodes()) {
			return $cbu;
		}

		//$date = $docFromCache->getElementsByTagName('ValCurs')->item(0)->getAttribute('Date');
		//$cbr->setDate($date);

		$currencyList = $this->getCurrencyList($docFromCache, $valuteTag);
		$this->fillCurrencyListFromXml($cbu, $currencyList, null, "valyuta", null, 'kurs', null);
		return $cbu;
	}
	/**
	 * @return OfficalRates_NBRB
	 */
	public function getNBRB(){
		$nbrb = new OfficalRates_NBRB();
		$valuteTag = 'Currency';

		$docFromCache = $this->getOffRateXmlFromCache('NBRB');
		if (!$docFromCache->hasChildNodes()) {
			return $nbrb;
		}

		$date = $docFromCache->getElementsByTagName('DailyExRates')->item(0)->getAttribute('Date');
		$date = Core_DateTime::toDateTime($date);
		$nbrb->setDate($date);

		if (!$this->ratesIsActual($date)){
			$docFromCache = $this->getOffRateXmlFromCache('CBR');
		}

		$currencyList = $this->getCurrencyList($docFromCache, $valuteTag);
		$this->fillCurrencyListFromXml($nbrb, $currencyList, 'NumCode', "CharCode", 'Scale', 'Rate', 'Name');
		return $nbrb;
	}

	/**
	 * @return OfficalRates_NBU
	 */
	public function getNBU(){
		$nbu = new OfficalRates_NBU();
		$valuteTag = 'item';

		$docFromCache = $this->getOffRateXmlFromCache('NBU');
		if (!$docFromCache->hasChildNodes()) {
			return $nbu;
		}

		$date = $docFromCache->getElementsByTagName('date')->item(0)->nodeValue;
		$date = Core_DateTime::toDateTime($date);
		$nbu->setDate($date);

		if (!$this->ratesIsActual($date)){
			$docFromCache = $this->getOffRateXmlFromCache('CBR');
		}

		$currencyList = $this->getCurrencyList($docFromCache, $valuteTag);
		$this->fillCurrencyListFromXml($nbu, $currencyList, 'code', "char3", 'size', 'rate', 'name');
		return $nbu;
	}

	private function ratesIsActual($cacheDate){
		$cacheDate = Core_DateTime::format($cacheDate, 'Y.m.d');
		$nowDate = date('Y.m.d');

		//$daynedeli = date("l");
		//if ($daynedeli = "Monday"){			
			//$cacheDayNadeli = Core_DateTime::format($cacheDate, "l")
			//if ($cacheDayNadeli == ""){
				//return true;
			//}	
		//}
		//if ($cacheDate < $nowDate) {
			//$this->refreshOfficalRatesCash();
			//return false;
		//}
		return true;
	}

	/**
	 * @return DOMDocument
	 */
	private function getOffRateXmlFromCache($bankName) {
		$cachePath = Core_Loader::getRootDir() . '/Cache/Data/' . $bankName . '.xml';
		if (!file_exists($cachePath)) {
			$this->refreshOfficalRatesCash();
		}

		$doc = $this->loadXmlFromFile($cachePath);
		if (!$doc->hasChildNodes()) {
			$this->refreshOfficalRatesCash();
			$doc = $this->loadXmlFromFile($cachePath);
		}
		return $doc;
	}

	/**
	 *
	 * @param unknown_type $path
	 * @return DOMDocument
	 */
	private function loadXmlFromFile($path){
		$doc = new DOMDocument();
		try{
			$doc->load($path);
		}
		catch(Exception $err){
			//TODO получить заново данные из нэта

		}
		return $doc;
	}

	/**
	 * @return DOMDocument
	 */
	private function httpXmlGet($url){
		$httpClient = Application_Registry::getHttpClient();
		$result = $httpClient->httpXmlGet($url);
		return $result;
	}

	private function getCurrencyList(DOMDocument $xmlDoc, $tagName){
		return $xmlDoc->getElementsByTagName($tagName);
	}

	private function fillCurrencyListFromXml(OfficalRates_OfficalRates $bank, DOMNodeList $list, $numCode, $charCode, $nominal, $rate, $name){
		foreach ($list as $currencyTag) {
			$currency = new OfficalRates_Currency();
			$currency->setBank($bank);
			$currency->setCharCode($this->getXmlNodeValue($currencyTag, $charCode));
			$currency->setNumCode($this->getXmlNodeValue($currencyTag, $numCode));
			$currency->setNominal($this->getXmlNodeValue($currencyTag, $nominal));
			$currency->setRate($this->getXmlNodeValue($currencyTag, $rate));
			$currency->setName($this->getXmlNodeValue($currencyTag, $name));
			$bank->getCurrencyList()->addCurrency($currency);
		}
	}

	protected function getXmlNodeValue(DOMElement $node ,$nodeName){
		$result = $node->getElementsByTagName($nodeName)->item(0)->nodeValue;
		return $result;
	}
}