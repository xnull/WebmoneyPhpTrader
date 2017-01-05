<?php
/**
 * Работа с базой данных.
 */
class Model_DataBase{

	/**
	 * @var PDO
	 */
	private $pdo;

	private $server;
	private $user;
	private $pass;
	private $dbname;

	public function __construct($init = true){
		$db = Application_Registry::getConfig()->getChildNode('DataBase');

		$this->server = $db->getProperty('server');
		$this->user = $db->getProperty('user');
		$this->pass = $db->getProperty('pass');
		$this->dbname = $db->getProperty('dbname');

		if ($init) {
			$this->init();
		}
	}

	private function init(){
		try {
			$encoding='cp1251';
			$dsn = "mysql:host=$this->server;dbname=$this->dbname;charset=$encoding";
			$this->pdo = new PDO($dsn, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $encoding"));

		}
		catch(PDOException $e) {
			throw $e;
		}
	}

	public function setConnection($dsn, $user, $pass){
		try {
			$this->pdo = new PDO($dsn, $user, $pass);
		}
		catch(PDOException $e) {
			throw $e;
		}
	}

	public function execute($query){
		$query = $this->getQuery($query);

		$statement = $this->pdo->prepare($query);
		$statement->execute();

		$this->checkError($statement, $query);

		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	private function checkError(PDOStatement $statement, $query){
		if ($statement->errorCode() != 0) {
			$error = $statement->errorInfo();
			$this->writeToFileLog(Core_DateTime::getNowDate() . ' Query error: ' . $error[2] . '. Query: "' . (String) $query) . '"';
		}
	}

	private function getQuery($query){
		try{
			//$query = iconv('UTF-8', 'cp1251', (String) $query);
			$query = (String) $query;
		}
		catch(Exception $err){
			$query = (String) $query;
			$this->writeToFileLog(Core_DateTime::getNowDate() . 'iconv not correct. query: ' . (String) $query . '. Error: ' . $err->getMessage());
		}
		return $query;
	}

	private function writeToFileLog($text){
		$fileName = realpath(dirname(__FILE__)) . '/log.txt';
		file_put_contents($fileName, $text . "\n", FILE_APPEND);
	}


	public function getServer(){
		return $this->server;
	}

	public function getDbName(){
		return $this->dbname;
	}

	public function getUser(){
		return $this->user;
	}

	public function getPass(){
		return $this->pass;
	}
}