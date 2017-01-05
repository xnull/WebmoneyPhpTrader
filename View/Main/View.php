<?php
class View_Main_View extends View_View{

	protected function renderView(){
		include_once  View_View::getViewFolderPath() .'/Main/Template.php';
	}

	private function getDayLimit(){
		$input = new HTML_Element('input');
		$input->addAttr('type','text')->addAttr('name', 'dayLimit')->addAttr('value', $this->getVar('exchange')->getDayLimit());
		return $input->toString();
	}

	private function getCronStateHTML(){
		if ($this->getCronState() == "true") {
			return "Запущен";
		}
		return "Остановлен";
	}

	private function cronAction(){
		if ($this->getCronState() == "true") {
			return "Остановить";
		}
		return "Запустить";
	}

	private function getCronReverseState(){
		if ($this->getCronState() == 'true') {
			return 'deinitCron';
		}
		else{
			return 'initCron';
		}
	}

	private function getCronState(){
		$cron = $this->getVar("cron");
		return $cron->getProperty('running');
	}

	private function botAction(){
		$run = new HTML_Element('Select');
		$run->addAttr('name', 'run');
		$option1 = new HTML_Element('Option');
		$option1->addAttr("value", "true")->setBodyText("Запустить");
		$option2 = new HTML_Element('Option');
		$option2->addAttr("value", "false")->setBodyText("Остановить");

		$exch = $this->getVar("exchange");
		if ($exch->getRun() != "true") {
			$option2->addAttr("selected", "selected");
		}

		$run->addChild($option1)->addChild($option2);

		return $run->toString();
	}

	private function officalRate(){
		$exch = $this->getVar("exchange");
		$result = $exch->getOfficalRate();
		$result .= ' (' . Core_DateTime::format($exch->getBank()->getDate(), 'd-m-Y') . ')';
		return $result;
	}

	private function myPersentResultRate(){
		$exch = $this->getVar("exchange");
		$mypers = new HTML_Element('input');
		$mypersRate = $exch->offRateplusMyPesent();
		$mypers->addAttr('type', 'text')->addAttr('name', 'myPersent')->addAttr("value", $mypersRate);
		return $mypers->toString();
	}

	private function myPersent(){
		$exch = $this->getVar("exchange");
		return $exch->getMyPersent();
	}



	private function getMaxSumm(){
		$exch = $this->getVar("exchange");
		$maxSumm = new HTML_Element('input');
		$maxSumm->addAttr('type', 'text')->addAttr('name', 'maxSumm')->addAttr("value", $exch->getMaxSumm());
		return $maxSumm->toString();
	}

	private function getMinSumm(){
		$exch = $this->getVar("exchange");
		$minSumm = new HTML_Element('input');
		$minSumm->addAttr('type', 'text')->addAttr('name', "minSumm")->addAttr("value", $exch->getMinSumm());
		return $minSumm->toString();
	}

	private function botState(){
		$exch = $this->getVar("exchange");
		if ($exch->getRun() == "true") {
			return "Запущен";
		}
		return "Остановлен";
	}

	private function exchListToHTML(){
		$exchList = $this->getVar('exchList');

		$direction = $this->getVar('direction');
		if (!isset($direction)) {
			$direction = "WMZ_WMR";
		}

		$select = new HTML_Element('Select');
		$select->addAttr("name", "action");

		//$exchList = new Exchanger_ExchangesList_ExchangesList();
		foreach ($exchList->getIterator() as $exchange){
			$option= new HTML_Element('option');
			//$exchange = new Exchanger_ExchangesList_Exchange();
			$option->addAttr('value', $exchange->getDirection())->setBodyText("хочу " . $exchange->getWMSurce() . " отдам " . $exchange->getWMDest());
			if ($direction == $exchange->getDirection()) {
				$option->addAttr('selected', 'selected');
			}
			$select->addChild($option);
		}
		return $select->toString();
	}

	private function getBotRunningDirections(){
		$result = "<ul>";
		$exchList = $this->getVar('exchList');
		//$exchList = Application_Registry::getExchangerManager()->getExchangesList();
		foreach ($exchList->getIterator() as $exchange){
			//$exchange = new Exchanger_ExchangesList_Exchange();
			$botRun = $exchange->getRun();
			if ($botRun == "true"){
				$result .= "<li>" . $exchange->getDirection() . "</li>\n";
			}
		}
		$result .= "</ul>";
		return $result;
	}

	private function getDayLimitRemains(){
		return $this->getVar('dayLimitRemains');
	}

	private function getExchType(){
		$exch = $this->getVar("exchange");
		return $exch->getExchType();
	}

	private function getWmDestination(){
		$exch = $this->getVar("exchange");
		return $exch->getWMDest();
	}

	private function getWmSource(){
		$exch = $this->getVar("exchange");
		//$exch = new Exchanger_ExchangesList_Exchange();
		return $exch->getWMSurce();
	}
}

?>