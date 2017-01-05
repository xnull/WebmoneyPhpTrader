<?php

error_reporting(E_ALL) ;
ini_set('display_errors', 'On');

/**
 * Регистрирем обработчик загрузки классов
 */
spl_autoload_register (array('Core_Loader', 'load'));

/**
 * Загрузчик классов
 */
class Core_Loader{
	private $ROOT_DIR;
	const DS = DIRECTORY_SEPARATOR;
	private $initialized = false;

	/**
	 * Переменная - ссылка на лоадер (синглтон)
	 * @var Core_Loader
	 */
	private static $instance;

	public static function getRootDir(){
		return self::getInstance()->ROOT_DIR;
	}

	/**
	 * @return Core_Loader
	 */
	private static function getInstance()
	{
		if (empty(self::$instance))
		{
			self::$instance = new self();			
			self::$instance->ROOT_DIR = realpath(dirname(__FILE__).'/../');
		}
		return self::$instance;
	}

	private function __construct(){}
	private function __clone() {}

	/**
	 * Основной метод загрузки классов
	 * @param str $className имя создаваемого класса
	 */
	public static function load($className){
		$loader = self::getInstance();

		$classPath = str_replace("_", self::DS, $className);
		include_once $loader->getRootDir() .self::DS .$classPath .".php";
		return;
	}
}
?>