<?php
/**
 * Application_Registry инстанционирует объекты, и обеспечивает их единственность
 * во время выполнения программы.
 * Реализован как синглтон.
 */
class Application_Registry{
	/**
	 * @var Application_Registry
	 */
	private static $instance;
	private $cashObjects = array();

	/**
	 * @return Application_Registry
	 */
	private static function getInstance()
	{
		if (empty(self::$instance))
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct(){}

	private function __clone() {}

	/**
	 * @return Configs_Config
	 */
	public static function getConfig(){
		return self::get("Configs_Config");
	}

    /**
     * @static
     * @return Model_DataBase
     */
    public static function getDataBase(){
        return self::get("Model_DataBase");
    }
	
	/**
	 * @return OfficalRates_OfficalRates
	 */
	public static function getBank($bankName){
		$factory = self::get("OfficalRates_OfficalRatesFactory");
		$getMethod = 'get' . $bankName;
		return $factory->$getMethod();		
	}	

	public static function get($className){
		$registry = self::getInstance();
		if (!isset($registry->cashObjects[$className])){
			$registry->cashObjects[$className] = new $className();
		}
		return $registry->cashObjects[$className];
	}
	
	/**
	 * 
	 * @return Application_MyHttpClient
	 */
	public static function getHttpClient(){
		$proxy = self::getConfig()->getChildNode('Net')->getChildNode('Proxy');
		$httpClient = self::get('Application_MyHttpClient');
		//$httpClient = new Application_MyHttpClient();
		
		if ($proxy->getProperty('useProxy') == 'yes') {
			$httpClient->set_proxy($proxy->getProperty('ip'));
			$httpClient->set_proxy_credentials($proxy->getProperty('user'), $proxy->getProperty('pass'));
		}
		return $httpClient;
	}
	
	/**
	 * 
	 * @return Exchanger_Manager
	 */
	public static function getExchangerManager(){
		return self::get('Exchanger_Manager');
	}
	
	public static function deleteClass($className){
		$registry = self::getInstance();
		unset($registry->cashObjects[$className]);
	}
}