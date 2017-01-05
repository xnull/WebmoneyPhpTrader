<?php

/**
 * Типы моих заявок на бирже
 */
class Exchanger_ListMyPays_BidType{
	/**
	 * Только неоплаченные заявки
	 * @var Integer 
	 */
	const NOTPAYED = "0";
	/**
	 * Оплаченные заявки, но еще не погашенные (по которым еще идет обмен)
	 * @var Integer
	 */
	const PAYED = "1";
	/**
	 * Только уже погашенные заявки
	 * @var Integer
	 */
	const SUCCESSED = "2";
	
	/**
	 * Все заявки независимо от сосотояния
	 * @var Integer
	 */
	const ALLTYPES = "3";
}