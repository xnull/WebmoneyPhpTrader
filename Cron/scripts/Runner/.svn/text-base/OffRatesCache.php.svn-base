<?php
$loader = realpath(dirname(__FILE__) . '/../../../Core/Loader.php');
include_once $loader;

if (Cron_scripts_BotStatus::isRunning()) {
	$logMapper = new ORM_DataMapper_Log_Log();
	
	//$log = new Log_Log();
	//$log->setMessage('Start OffratesCache');
	//$logMapper->save($log);

	$ratesCache = new Cron_scripts_OffRatesCache();
	$ratesCache->run();
}

