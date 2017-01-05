<?php

/**
 * Класс пространства имен, с константами пространства имен.
 * В принципе по этому классу можно создавать каркас сайта
 * (создавать папки из констант - начальная инициализация)
 */
class NameSpace{
	const Application = "Application.";
	const ORM         = "ORM.";
}

/**
 * ПРИМЕР. Базовый класс неймспэсовый для всех классов приложения.
 * Все остальные классы будут наследниками от NameSpaced, реализуя метод
 * createInstance - для создания класса из своего пространства имен.
 * Предусмотреть механизм, если класса нет в своём пространстве имен, 
 * чтоб была загрузка из подключаемого пространства имен.
 * чета типа use.
 */

abstract class NameSpaced{
	private $nameSpace = NameSpace::Application;

	function createInstance($className){
		return new $this->nameSpace . "\\" . $className;
	}
}

?>