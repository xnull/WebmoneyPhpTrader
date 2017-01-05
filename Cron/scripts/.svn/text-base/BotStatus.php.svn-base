<?php

class Cron_scripts_BotStatus{

	public static function isRunning(){
		$botStatus = Application_Registry::getConfig()->getChildNode('Cron')->getProperty('running');
		if ($botStatus != 'true') {
			return false;
		}
		return true;
	}	
}