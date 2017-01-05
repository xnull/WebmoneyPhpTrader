<?php
class Exchanger_OrderList_OrderList extends Core_Collections_HashMap{
	const URL = "https://wm.exchanger.ru/asp/XMLWMList.asp";
	private $exchType;
	private $wmidNumber;
	private $officalRateInExchanger;

	/**
	 * Список заявок на бирже
	 * @param int $exchType направление обмена
	 */
	public function __construct($exchType){
		if (!isset($exchType)) {
			throw new Exception('Задайте значение exchType');
		}
		$this->exchType = (int)$exchType;
	}

	public function getOfficalRateInExchanger(){
		return $this->officalRateInExchanger;
	}

	public function setOfficalRateInExchanger($rate){
		$this->officalRateInExchanger = $rate;
	}

	public function getQueryUrl(){
		return self::URL ."?exchtype=" . $this->exchType;
	}

	public function getExchType(){
		return $this->exchType;
	}

	/**
	 * @return Exchanger_OrderList_Order
	 */
	public function getOrder($orderId){
		return $this->getValue($orderId);
	}

	/**
	 *
	 * @return Exchanger_OrderList_Order
	 */
	public function getFirstOrder(){
		return $this->getIterator()->rewind()->current();
	}

	public function add(Exchanger_OrderList_Order $order){
		$this->hashMap[$order->getId()] = $order;
	}
}

?>