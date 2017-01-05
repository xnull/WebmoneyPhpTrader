<?php
/**
 * Работа с кроном. Инициализация и удаление крон файла.
 * Запускать из под клнечного пользователя!
 */

/**
 * Допустимые значения:
 * минута        от 0 до 59
 * час           от 0 до 23
 * день_месяца   от 1 до 31
 * месяц         от 1 до 12 (можно три буквы из названия месяца,
                             регистр не имеет значения от jan до dec)
 * день_недели   от 0 до 6  (0 это воскресенье,
                          можно писать от sun до sat)
 */

class Cron_Cron {
	private $schedulePath;
	private $tasks = array ();

	public function __construct() {
		$this->schedulePath = realpath ( dirname ( __FILE__ ) ) . '/schedule';
	}

	public function init(){
		$this->command ( 'crontab ' . $this->schedulePath );
	}

	public function delete() {
		//crontab -r  - удаление файла планирощика юзера
		$this->command ( 'crontab -r' );
	}

	public function show() {
		return $this->command ( "crontab -l" );
	}

	private function command($shellCommand) {
		exec ( $shellCommand );
	}
}