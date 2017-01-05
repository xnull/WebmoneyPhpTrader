<?php
/**
 * Конкретный композитный класс.
 */
class Application_Composite extends Application_AbstractComposite{
	public function __construct($name, Application_AbstractComposite $parentNode){
		parent::__construct($name, $parentNode);		
	}	
}