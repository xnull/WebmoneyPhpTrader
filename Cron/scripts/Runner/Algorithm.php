<?php
/**
 * Алгоритм. Запуск раз в минуту
 */
$loader = realpath(dirname(__FILE__) . '/../../../Core/Loader.php');
include_once $loader;

if (Cron_scripts_BotStatus::isRunning()) {
	$logMapper = new ORM_DataMapper_Log_Log();
	
	//$log = new Log_Log();
	//$log->setMessage('Start Algorithm');
	//$logMapper->save($log);

	$algo = new Algorithm_MainChain_Algorithm();
	$algo->start();
}


?>