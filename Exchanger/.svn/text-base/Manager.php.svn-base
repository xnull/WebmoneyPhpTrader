<?php
class Exchanger_Manager {
	/**
	 *
	 * @return Exchanger_ExchangesList_ExchangesList
	 */
	public function getExchangesList() {
		if (Cache_Cache::get ( 'exchnagesList' ) == null) {
			Cache_Cache::add ( 'exchnagesList', new Exchanger_ExchangesList_ExchangesList () );
		}
		return Cache_Cache::get ( 'exchnagesList' );
	}

	/**
	 *
	 * @param Application_Composite $wmid
	 * @param $bidtype
	 * @param $queryid
	 * @return Exchanger_ListMyPays_ListMyPays
	 */
	public function getListMyPays(Application_Composite $wmid, $bidtype, $queryid = null) {
		$listMyPaysFactory = new Exchanger_ListMyPays_Factory ();
		return $listMyPaysFactory->getListMyPays ( $wmid, $bidtype, $queryid );
	}

	/**
	 * Постанока новой заявки на биржу.
	 * @param Application_Composite $wmid
	 * @param str $inpurse номер кошелька ВМ-идентификатора wmid, с которого необходимо взять сумму к обмену для постановки заявки
	 * @param str $outpurse номер кошелька ВМ-идентификатора wmid, на который будут поступать средства по мере обмена
	 * @param double $inamount сумма, которая будет автоматически переведена с кошелька inpurse на кошелек сервиса секции wm.exchanger и выставлена к обмену
	 * @param double $outamount сумма, которую необходимо перевести на кошелек outpurse по завершению обмена
	 * @return Exchanger_OperationResultNewPay
	 */
	public function newPay(Application_Composite $wmid, $inpurse, $outpurse, $inamount, $outamount) {
		$request = new Exchanger_NewPay_Request ( $wmid, $inpurse, $outpurse, $inamount, $outamount );
		$newMyPay = new Exchanger_OperationResultNewPay ();
		$newMyPay->init( $this->getXmlAnsver ( $request ) );
		return $newMyPay;
	}

	/**
	 *
	 * @param Application_Composite $wmid
	 * @param unknown_type $queryid
	 * @return Exchanger_OppositeOrders_List
	 */
	public function getOppositeOrders(Application_Composite $wmid, $queryid = null) {
		$request = new Exchanger_OppositeOrders_Request ( $wmid, $queryid );
		return new Exchanger_OppositeOrders_List ( $this->getXmlAnsver ( $request ) );
	}

	/**
	 *
	 * @param unknown_type $exchType
	 * @return Exchanger_OrderList_OrderList
	 */
	public function getOrderList($exchType) {
		$orderListFactory = new Exchanger_OrderList_Factory ();
		if (Cache_Cache::get ( 'orderList' . $exchType ) == null) {
			Cache_Cache::add ( 'orderList' . $exchType, $orderListFactory->get ( $exchType ) );
		}
		return Cache_Cache::get ( 'orderList' . $exchType );
	}

	/**
	 *
	 * @param $wmid
	 * @param $operid
	 * @return Exchanger_OperationResult
	 */
	public function deleteOrder(Application_Composite $wmid, $operid = null) {
		$request = new Exchanger_OrderRemover_Request ( $wmid, $operid );
		return new Exchanger_OperationResult ( $this->getXmlAnsver ( $request ) );
	}

	/**
	 *
	 * @param Application_Composite $wmid
	 * @param unknown_type $operid
	 * @param unknown_type $unionoperid
	 * @return Exchanger_OperationResult
	 */
	public function unionOrders(Application_Composite $wmid, $operid, $unionoperid) {
		$request = new Exchanger_OrdersUnion_Request ( $wmid, $operid, $unionoperid );
		return new Exchanger_OperationResult ( $this->getXmlAnsver ( $request ) );
	}

	/**
	 *
	 * @param Application_Composite $wmid
	 * @param unknown_type $operid
	 * @param unknown_type $curstype
	 * @param unknown_type $cursamount
	 * @return Exchanger_OperationResult
	 */
	public function changeRate(Application_Composite $wmid, $operid = null, $curstype, $cursamount) {
		$request = new Exchanger_RateChanger_Request ( $wmid, $operid, $curstype, $cursamount );
		return new Exchanger_OperationResult ( $this->getXmlAnsver ( $request ) );
	}

	/**
	 *
	 * @param $wmid
	 * @param $isxtrid
	 * @param $desttrid
	 * @param $deststamp
	 * @return Exchanger_OperationResult
	 */
	public function sale(Application_Composite $wmid, $isxtrid, $desttrid, $deststamp = null) {
		$request = new Exchanger_Sale_Request ( $wmid, $isxtrid, $desttrid, $deststamp );
		return new Exchanger_OperationResult ( $this->getXmlAnsver ( $request ) );
	}

	/**
	 *
	 * @param Webmoney_XmlRequest $request
	 * @return DOMDocument
	 */
	private function getXmlAnsver(Webmoney_XmlRequest $request) {
		try {
			$httpClient = Application_Registry::getHttpClient ();
			//$httpClient->useSSL();
			return $this->strToDOM ( $httpClient->send_post_data ( $request->getUrl(), $request->toString() ) );
		} catch ( Exception $err ) {
			$log = new Log_Log ();
			$log->setDate ( Log_Log::getNowDate () );
			$log->setMessage ( 'Ошибка при полчении данных с сайта: ' . $err );
			$logMapper = new ORM_DataMapper_Log_Log ();
			$logMapper->save ( $log );
		}
	}

	private function getGetXmlAnsver($url) {
		$httpClient = Application_Registry::getHttpClient ();
		return $this->strToDOM ( $httpClient->fetch_url ( $url ) );
	}

	private function strToDOM($string) {
		if ($string == null) {
			return null;
		}
		$dom = new DOMDocument ( '1.0', 'Windows-1251' );
		$dom->loadXML ( $string );
		return $dom;
	}
}

