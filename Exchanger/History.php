<?php
/**
 * —охранение истории операций в базу данных.
 * ѕринимает два объекта - мо€ за€вка и за€вка с биржи, и должна сохранить в базе.
 * Ќужно будет сделать св€зь многие ко многим. “ак как € могу купить несколько за€вок
 * и одна за€вка на бирже может быть куплена несколькими моими за€вками
 */
class Exchanger_History extends Application_DomainObject{
	/**
	 *
	 * @var Exchanger_ListMyPays_MyPay
	 */
	private $myPay;
	/**
	 *
	 * @var Exchanger_OrderList_Order
	 */
	private $purchasedOrder;
	
	private $myPayId;
	private $purchasedOrderId;
	private $date;
	
	private $cbRate;
	private $myPersent;
	
	
	private $purseSumm;
	
	public function getPurseSumm(){
		return $this->purseSumm;
	}
	
	public function setPurseSumm($summ){
		$this->purseSumm = $summ;
	}
	

	/**
	 * @return the $cbRate
	 */
	public function getCbRate() {
		return $this->cbRate;
	}

	/**
	 * @return the $myPersent
	 */
	public function getMyPersent() {
		return $this->myPersent;
	}

	/**
	 * @param $cbRate the $cbRate to set
	 */
	public function setCbRate($cbRate) {
		$this->cbRate = $cbRate;
	}

	/**
	 * @param $myPersent the $myPersent to set
	 */
	public function setMyPersent($myPersent) {
		$this->myPersent = $myPersent;
	}

	public function getId(){
		$id = $this->myPay->getId() + $this->purchasedOrder->getId() + rand(1, 1000000);
		return $id;
	}

	public function setDate($date){
		$this->date = Core_DateTime::toDateTime($date);
	}

	public function getDate(){
		return $this->date;
	}

	/**
	 *
	 * @return Exchanger_ListMyPays_MyPay
	 */
	public function getMyPay(){
		return $this->myPay;
	}

	public function setMyPay(Exchanger_ListMyPays_MyPay  $myPay){
		$this->myPay = $myPay;
		$this->myPayId = $myPay->getId();
	}

	/**
	 *
	 * @return Exchanger_OrderList_Order
	 */
	public function getPurchasedOrder(){
		return $this->purchasedOrder;
	}

	public function setPurchasedOrder(Exchanger_OrderList_Order $purchasedOrder){
		$this->purchasedOrder = $purchasedOrder;
		$this->purchasedOrderId = $purchasedOrder->getId();
	}

	public function getMyPayId(){
		if ($this->myPayId != null){
			return $this->myPayId;
		}
		return $this->myPay->getId();
	}

	public function getPurchasedOrderId(){
		if ($this->purchasedOrderId != null) {
			return $this->purchasedOrderId;
		}
		return $this->purchasedOrder->getId();
	}

	public function setMyPayId($id){
		$this->myPayId = $id;
	}

	public function setPurchasedOrderId($id){
		$this->purchasedOrderId = $id;
	}
}