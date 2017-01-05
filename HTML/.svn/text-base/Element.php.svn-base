<?php
class HTML_Element{
	protected $name;
	/**
	 * Дочерние хтмл элементы
	 * @var HTML_Element
	 */
	protected $child = array();
	protected $attributes = array();
	
	protected $bodyText;
	
	/**
	 * 
	 * @param unknown_type $name
	 * @return HTML_Element
	 */
	public function __construct($name = null){
		if ($name == null) {
			throw new Exception('Необходимо задать имя HTML элемента');
		}
		$this->name = $name;
		return $this;
	}
	
	public function setBodyText($text){
		$this->bodyText = $text;
	}
		
	/**
	 * Добавить аттрибут к хтмл элементу
	 * @param String $name имя аттрибута
	 * @param String $value значение аттрибута
	 * @return HTML_Element
	 */
	public function addAttr($name, $value){
		$this->attributes[$name] = $value;
		return $this;
	}
	
	public function getAttr($name) {
		return $this->attributes[$name];
	}

	public function getName(){
		return $this->name;
	}
	
	/**
	 * 
	 * @param HTML_Element $element
	 * @return HTML_Element
	 */
	public function addChild(HTML_Element $element){
		if ($element instanceof HTML_Element) {
			$this->child[] = $element;
		}
		else {
			throw new Exception("Добавляемый элемент не является HTML элементом");
		}
		return $this;
	}

	public function toString(){
		$html = $this->getElementBodyString();				
		
		$html .= $this->bodyText;
		
		if (count($this->child) > 0) {
			$html .= "\n";
		}
		
		foreach ($this->child as $childElement) {
			$html .= $childElement->toString();
		}
		
		$html .= $this->getEndTagString();
		$html .= "\n";
		return $html;
	}	

	protected function getElementBodyString(){
		$elementBody = '<' . $this->getName();
		foreach ($this->attributes as $name => $value) {
			$elementBody .= ' ' . $name . '="' . $value . '"';
		}
		$elementBody .= '>';
		return $elementBody;
	}

	protected function getEndTagString() {
		return '</' . $this->getName() .'>';
	}
	
	public function __toString(){
		return $this->toString();
	}
}

?>