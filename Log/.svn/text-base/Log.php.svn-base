<?php
class Log_Log extends Application_DomainObject{
	private $message;
	private $date;

	public function getMessage(){
		return $this->message;
	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function getDate(){
		if ($this->date != null) {
			return Core_DateTime::toDateTime($this->date);
		}
		return self::getNowDate();
	}

	public function setDate($date){
		$this->date = $date;
	}

	public static function getNowDate(){
		return date("Y-m-d H:i:s");
	}

	public static function saveToDatabase($message){
		$logMapper = new ORM_DataMapper_Log_Log();
		$log = new Log_Log();
		$log->setMessage($message);
		$logMapper->save($log);
	}
}