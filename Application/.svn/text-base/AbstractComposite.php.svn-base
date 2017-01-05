<?php
abstract class Application_AbstractComposite {
	protected $childNodes = array();
	protected $properties = array();
	/**
	 * 
	 * @var String »м€ композитного класса 
	 */
	protected $name;
	/**
	 * 
	 * @var Application_AbstractComposite ссылка на родительский узел
	 */
	protected $parentNode;	
	
	/**
	 *  онструктор
	 * @param String $name им€ создаваемого класса
	 * @param Application_AbstractComposite $parentNode ссылка на родительский узел
	 */
	public function __construct($name, Application_AbstractComposite $parentNode){
		$this->name = $name;
		$this->parentNode = $parentNode;		
	}

	/**
	 * @return String им€ класса
	 */
	public function getName(){
		return $this->name;
	}
	
	/**
	 * ƒобавление дочернего узла, в класс
	 * @param Application_AbstractComposite $node  омпозитный класс добавл€емый в родительский класс
	 */
	public function addChildNode(Application_AbstractComposite $node){		
		$this->childNodes[$node->name] = $node;
	}
	
	/**
	 * ѕолучить дочерний класс
	 * @param $name им€ дочернего класса
	 * @return Application_AbstractComposite
	 */
	public function getChildNode($name){
		if (isset($this->childNodes[$name])) {
			return $this->childNodes[$name];
		}
		throw new Exception('child node not exsist');
	}
	
	public function addProperty($name, $value){
		$this->properties[$name] = $value;
	}
	
	
	public function getProperty($name){
		return $this->properties[$name];
	}
	
	/**
	 * »тератор по дочерним узлам класса
	 * @return array()
	 */
	public function getNodeIterator(){
		return $this->childNodes;
	}
	
	/**
	 * »тератор по свойсвам класса
	 * @return array()
	 */
	public function getPropertiesIterator(){
		return $this->properties;
	}
}

?>