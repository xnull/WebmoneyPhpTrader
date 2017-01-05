<?php
/**
 * Контроллер загружаемый по умолчанию
 */
class Controller_Main_Controller extends Controller_Controller{

	public function index(){
		$this->getWMCurrencyeslist("WMZ_WMR");
		$this->getCron();
		$this->getDayLimitRemains("WMZ_WMR");
		$this->view->display();
	}

	private function getDayLimitRemains($direction){
		$exchType = Application_Registry::getExchangerManager()->getExchangesList()->getExchTypeFromDirection($direction);
		$dayLimitMapper = new ORM_DataMapper_Exchanger_ExchangesList_Limit();
		$dayLimit = $dayLimitMapper->find($exchType);
		$this->view->add("dayLimitRemains", $dayLimit->getRemains());
	}

	private function getCron(){
		$cron = Application_Registry::getConfig()->getChildNode('Cron');
		$this->view->add("cron", $cron);
	}

	private function getWMCurrencyeslist($direction = "WMZ_WMR"){
		$exchList = Application_Registry::getExchangerManager()->getExchangesList();
		$exch = null;
		try{
			$exch = $exchList->getExchange($direction);
		}
		catch (Exception $err){
			die ('такого направления обмена не существует');
		}

		$this->view->add("exchList" ,$exchList);
		$this->view->add("exchange", $exch);
		$this->view->add('direction', $direction);
	}

	public function initCron(){
		$this->initAction('true');
	}

	public function deinitCron(){
		$this->initAction('false');
	}

	private function initAction($newState){
		$this->saveCronState($newState);
		$this->index();
	}

	private function saveCronState($newState){
		//сохранить изменения
		$config = Application_Registry::getConfig();
		$config->xpathQuery('//Cron')->item(0)->setAttribute('running', $newState);
		$config->save();
	}

	public function save(){
		/**
		 * $this->request->getGetParam('myPersent') - это не мой процент, а результирующий курс заявки которую нужно купить
		 */
		$direction = $this->request->getGetParam('direction');
		$config = Application_Registry::getConfig();
		$xmlSettings = $config->xpathQuery('//Exchanges/' . $direction . '/Settings')->item(0);
		$xmlSettings->setAttribute('minSumm', $this->request->getGetParam('minSumm'));
		$xmlSettings->setAttribute('maxSumm', $this->request->getGetParam('maxSumm'));

		$myPersent = $this->getMyPersentFromResultRate($direction, $this->request->getGetParam('myPersent'));
		$xmlSettings->setAttribute('myPersent', $myPersent);
		$xmlSettings->setAttribute('run', $this->request->getGetParam('run'));

		//$xmlSettingsReverseDirection = $config->xpathQuery('//Exchanges/' . Exchanger_Direction::getReverseDirection($direction) . '/Settings')->item(0);
		
		$configDayLimit = $xmlSettings->getAttribute('dayLimit');
		
		$xmlSettings->setAttribute('dayLimit', $this->request->getGetParam('dayLimit'));
		$config->save();
		
		if ($configDayLimit != $this->request->getGetParam('dayLimit')) {
			//сохраняем новый дневной лимит в базу
			$dayLimitChecker = new Cron_scripts_DayLimitChecker();
			$dayLimitChecker->run();
		}		

		$this->view = new View_SaveComplete_View();
		$this->view->add('direction', $direction);

		$this->view->display();
	}

	private function getMyPersentFromResultRate($direction, $resultRate){
		$exchList = Application_Registry::getExchangerManager()->getExchangesList();
		$exchange = $exchList->getExchange($direction);
		$bankPersent = Core_Double::toDouble($resultRate)/Core_Double::toDouble($exchange->getOfficalRate())*100;
		$myPersent = $bankPersent - 100;
		return $this->trimToThreeCipher($myPersent);
	}

	private function trimToThreeCipher($value) {
		return ceil ( $value * 1000 ) / 1000;
	}

	public function refreshRates(){
		$offFactory = new OfficalRates_OfficalRatesFactory();
		$offFactory->refreshOfficalRatesCash();
		$direction = $this->request->getGetParam('direction');

		if ((substr($direction, 0, 2) != 'WM') or (substr($direction, 4, 2) != 'WM') or (strlen($direction) != 7)) {
			$direction = 'WMZ_WMR';
		}

		$this->$direction();
	}

	private function dayLimitIsChange(DOMElement $xmlSettings){		
		if ($xmlSettings->getAttribute('dayLimit') == $this->request->getGetParam('dayLimit')) {
			return false;
		}
		return true;
	}

	public function __call($name, $arguments){
		if ((substr($name, 0, 2) != 'WM') or (substr($name, 4, 2) != 'WM') or (strlen($name) != 7)) {
			$name = 'WMZ_WMR';
		}

		$this->getWMCurrencyeslist($name);
		$this->getCron();
		$this->getDayLimitRemains($name);
		$this->view->display();
	}
}
?>