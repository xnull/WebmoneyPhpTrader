<?php
class Cache_Cache {
	/**
	 *
	 * @var Cache_Cache
	 */
	private static $instance;
	private $cash = array();

	/**
	 *
	 * @var Cache_Cache
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

	public static function get($name) {
		$instance = self::getInstance();
		if (isset($instance->cash[$name])) {
			return $instance->cash[$name];
		}
		return null;
	}

	public static function add($name, $resource){
		$instance = self::getInstance();
		$instance->cash[$name] = $resource;
	}
}