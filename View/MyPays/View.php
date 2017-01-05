<?php
class View_MyPays_View extends View_View {
	
	protected function renderView() {
		include_once View_View::getViewFolderPath () . '/MyPays/Template.php';
	}
	
	public function getListMyPaysHtmlTable() {		
		$listMyPays = $this->getVar ( 'listMyPays' );
		
		$htmlTable = $this->createHtmlTable ();
		$htmlTable->addChild ( $this->createHead () );
				
		foreach ( $listMyPays->getIterator() as $myPay ) {
			$htmlTR = new HTML_Element ( 'tr' );
			$htmlTR->addChild ( $this->createTR ( $myPay) );
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
				
		$thMyPay = new HTML_Element ( 'th' );
		$thMyPay->addAttr ( 'colspan', '11' )->setBodyText ( 'Мои заявки' );
					
		$htmlTRHead->addChild ( $thMyPay );
		$htmlTable->addChild ( $htmlTRHead );
		return $htmlTable;
	}
	
	private function createHead() {
		$tr = new HTML_Element ( 'tr' );		
		
		$tr->addChild ( $this->createTD ( 'ID заявки' ) );
		$tr->addChild ( $this->createTD ( 'Статус заявки' ) );
		$tr->addChild ( $this->createTD ( 'Направление обмена' ) );
		$tr->addChild ( $this->createTD ( 'wmid' ) );
		
		$tr->addChild ( $this->createTD ( 'Cумма' ) );
		$tr->addChild ( $this->createTD ( 'Курс' ) );
		
		$tr->addChild ( $this->createTD ( 'Кошелек источник' ) );
		$tr->addChild ( $this->createTD ( 'Кошелек приемник' ) );
		
		$tr->addChild ( $this->createTD ( 'AmountIN/AmountOut' ) );
		
		$tr->addChild ( $this->createTD ( 'Дата постановки' ) );
		$tr->addChild ( $this->createTD ( 'Дата последнего изменения' ) );
				
		return $tr;
	}
	
	private function createTR(Exchanger_ListMyPays_MyPay  $myPay) {
		$tr = new HTML_Element ( 'tr' );
		
		$tr->addChild ( $this->createTD ( $myPay->getId () ) );
		$tr->addChild ( $this->createTD ( $myPay->getStateDescription() . "(" . $myPay->getState() . ")" ) );
		$tr->addChild ( $this->createTD ( $myPay->getDirection () . "(" . $myPay->getExchType() . ")" ) );
		$tr->addChild ( $this->createTD ( $myPay->getWmidNumber () ) );
		
		$tr->addChild ( $this->createTD ( $myPay->getSumm () ) );
		$tr->addChild ( $this->createTD ( $myPay->GetRateExchanger() ) );
		
		$tr->addChild ( $this->createTD ( $myPay->getInPurse () ) );
		$tr->addChild ( $this->createTD ( $myPay->getOutPurse () ) );
		
		$tr->addChild ( $this->createTD ( $myPay->getAmountin() . "/"  . $myPay->getAmountOut()) );
		
		$tr->addChild ( $this->createTD ( $myPay->getQueryDateCr () ) );
		$tr->addChild ( $this->createTD ( $myPay->getQueryDate () ) );
				
		
		
		
				
		return $tr;
	}	
		
	private function createTD($value) {
		$td = new HTML_Element ( 'td' );
		$td->setBodyText ( $value );
		return $td;
	}

}