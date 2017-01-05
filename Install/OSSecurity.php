<?php
/**
 * Запускать из под юзера, под которым будут запускаться кроновские задания.
 *
 * Но, и это не все! Нельзя просто вписать в PHP-скрипт команду
 * 	chmod('myscript.php', 755);
 *
 * Чтобы сделать файл myscript.php выполняемым: Команда chmod принимает значение прав только в 8-ричном формате!
 * 	chmod('myscript.php', 0755);
 *
 */
class Install_OSSecurity{
	private $installDir;

	public function __construct(){
		$this->installDir = realpath(dirname(__FILE__));
	}

	public function setAttrsForCache(){
		$this->checkWWWUser();
				
		$cacheDataDir = $installDir . '/../Cache/Data';
		chmod($cacheDataDir . '/CBR.xml', 0766);
		chmod($cacheDataDir . '/NBU.xml', 0766);
	}
	
	public function setAttrsForConfig(){
		$this->checkWWWUser();
		
		$config = $this->installDir . '/../Configs/Config.xml';
		chmod($config, 0766);
	}
	
	

	private function checkWWWUser(){
		$login = posix_getlogin();
		if ($login == 'www') {
			throw new Exception('Не запускать этот скрипт под учеткой WWW!');
		}		
	}
}

$os = new Install_OSSecurity();
$os->setAttrsForCache();
$os->setAttrsForConfig();

?>



