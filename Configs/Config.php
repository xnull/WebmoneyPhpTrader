<?php
class Configs_Config extends Application_AbstractComposite{
	/**
	 * Объект DOMDocument в который загружен xml файл конфига.
	 * @var DOMDocument
	 */
	private $xmlDocument;

	public function __construct(){		
		$this->name = get_class($this);
		
		$this->xmlDocument = new DOMDocument("1.0", "Windows-1251");
		$this->xmlDocument->load($this->getPathToConfig());
				
		$this->build($this->xmlDocument->documentElement, $this);
	}

    private function getPathToConfig(){
        return realpath(dirname(__FILE__) . '/Config.xml');
    }
	
	/**
	 * @return DOMDocument;
	 */
	public function getXMLDocument(){
		return $this->xmlDocument;
	}
	
	public function setXMLDocument(DOMDocument $doc){
		$this->xmlDocument = $doc;
	}
	
	/**
	 * Создаем из узла в хмл документе, класс Composite и заполняем созданный класс данными из хмл файла
	 * @param DOMElement $xmlNode узел хмл документа
	 * @param Application_AbstractComposite $parentConfigNode родительский класс
	 */
	private function build(DOMElement $xmlNode, Application_AbstractComposite $parentConfigNode){
		foreach ($xmlNode->childNodes as $currentXMLNode) {
			if ($currentXMLNode->nodeType == XML_ELEMENT_NODE) {
				$currentConfigNode = new Application_Composite($currentXMLNode->nodeName, $parentConfigNode);
				
				foreach ($currentXMLNode->attributes as $currentXMLAttribute) {
					$currentConfigNode->addProperty($currentXMLAttribute->name, $currentXMLAttribute->value);
				}				
				
				$parentConfigNode->addChildNode($currentConfigNode);
				$this->build($currentXMLNode, $currentConfigNode);
			}
		}
	}

	public function save(){
		$this->xmlDocument->save(realPath(dirname(__FILE__)) . '/Config.xml');
		Application_Registry::deleteClass('Configs_Config');
	}
	
	/**
	 * @return DOMNodeList
	 */
	public function xpathQuery($query){
		$xpath = new DOMXPath($this->xmlDocument);
		return $xpath->query($query);
	}
}

?>
