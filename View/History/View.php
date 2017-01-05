<?php
class View_History_View extends View_View {

	protected function renderView() {
		include_once View_View::getViewFolderPath () . '/History/Template.php';
	}

	public function getHistoryListHtmlTable() {
		$historyList = $this->getVar ( 'historyList' );

		$htmlTable = $this->createHtmlTable ();
		$htmlTable->addChild ( $this->createHead () );

		foreach ( $historyList->iterator() as $history ) {
			$htmlTR = new HTML_Element ( 'tr' );
			$htmlTR->addChild ( $this->createTR ( $history) );
			$htmlTable->addChild ( $htmlTR );
		}
		return $htmlTable->toString ();
	}

	/**
	 * @return HTML_Element
	 */
	private function createHtmlTable() {
		$htmlTable = new HTML_Element ( 'table' );
		$htmlTable->addAttr ( "border", "1" );

		$htmlTRHead = new HTML_Element ( 'tr' );

		$thCommon = new HTML_Element ( 'th' );
		$thCommon->addAttr ( 'colspan', '5' )->setBodyText ( 'Общее' );


		$thMyPay = new HTML_Element ( 'th' );
		$thMyPay->addAttr ( 'colspan', '9' )->setBodyText ( 'Моя заявка' );

		$thPurchase = new HTML_Element ( 'th' );
		$thPurchase->addAttr ( 'colspan', '5' )->setBodyText ( 'Купленная заявка' );

		$htmlTRHead->addChild($thCommon)->addChild ( $thMyPay )->addChild ( $thPurchase );
		$htmlTable->addChild ( $htmlTRHead );
		return $htmlTable;
	}

	private function createHead() {
		$tr = new HTML_Element ( 'tr' );

		$tr->addChild ( $this->createTD ( 'Дата' ) );
		$tr->addChild ( $this->createTD ( 'Направление обмена (купил/отдал)' ) );
		$tr->addChild ( $this->createTD ( 'Курс ЦБ' ) );
		$tr->addChild ( $this->createTD ( 'Мой курс / процент' ) );
		$tr->addChild ( $this->createTD ( 'Сумма покупки' ) );

		$tr->addChild ( $this->createTD ( 'ID заявки' ) );
		$tr->addChild ( $this->createTD ( 'Напрвление обмена (отдал/получил)' ) );
		$tr->addChild ( $this->createTD ( 'wmid' ) );

		$tr->addChild ( $this->createTD ( 'Cумма' ) );
		$tr->addChild ( $this->createTD ( 'Курс' ) );

		$tr->addChild ( $this->createTD ( 'Кошелек источник' ) );
		$tr->addChild ( $this->createTD ( 'Кошелек приемник' ) );

		$tr->addChild ( $this->createTD ( 'Дата постановки' ) );
		$tr->addChild ( $this->createTD ( 'Дата последнего изменения' ) );


		$tr->addChild ( $this->createTD ( 'id' ) );
		$tr->addChild ( $this->createTD ( 'Курс' ) );

		return $tr;
	}

	private function createTR(Exchanger_History $history) {
		$myPay = $history->getMyPay();
		$purchasedOrder = $history->getPurchasedOrder();

		$tr = new HTML_Element ( 'tr' );

		$tr->addChild ( $this->createTD ( $history->getDate() ) );
		$direction = Application_Registry::getExchangerManager()->getExchangesList()->getDirectionFromExchType($purchasedOrder->getExchType());
		$tr->addChild ( $this->createTD ( $direction ) );
		$tr->addChild ( $this->createTD ( $history->getCbRate() ) );

		$myPersent = $history->getMyPersent();
		if ($myPersent == null) {
			$myPersent = 0;
		}
		$persent = Core_Double::toDouble($history->getCbRate())*Core_Double::toDouble($myPersent)/100;
		$resultRate = $history->getCbRate() + $persent;

		$tr->addChild ( $this->createTD ( $this->trimToThreeCipher($resultRate) . " / " . $myPersent) );
		$tr->addChild ( $this->createTD ( $history->getPurseSumm() . " (" . Exchanger_Direction::getWMSourceFromDirection($direction) . ")" ) );

		$tr->addChild ( $this->createTD ( $myPay->getId () ) );
		$tr->addChild ( $this->createTD ( $myPay->getDirection () ) );
		$tr->addChild ( $this->createTD ( $myPay->getWmidNumber () ) );

		$tr->addChild ( $this->createTD ( $myPay->getAmountin() . " (" . Exchanger_Direction::getWMSourceFromDirection($myPay->getDirection()) . ")" ));
		$tr->addChild ( $this->createTD ( $myPay->GetRateExchanger () ) );

		$tr->addChild ( $this->createTD ( $myPay->getInPurse () ) );
		$tr->addChild ( $this->createTD ( $myPay->getOutPurse () ) );

		$tr->addChild ( $this->createTD ( $myPay->getQueryDateCr () ) );
		$tr->addChild ( $this->createTD ( $myPay->getQueryDate () ) );

		$tr->addChild ( $this->createTD ( $purchasedOrder->getId() ) );
		$tr->addChild ( $this->createTD ( $purchasedOrder->GetRate() ) );

		return $tr;
	}

	private function createTD($value) {
		$td = new HTML_Element ( 'td' );
		$td->setBodyText ( $value );
		return $td;
	}

	private function trimToThreeCipher($value) {
		return ceil ( $value * 1000 ) / 1000;
	}

}