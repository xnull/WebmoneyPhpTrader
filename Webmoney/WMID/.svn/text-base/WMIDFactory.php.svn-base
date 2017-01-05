<?php
class Webmoney_WMID_WMIDFactory {
	/**
	 *
	 * @var Webmoney_WMID_WMIDList
	 */
	private $wmidList;
	
	public function __construct(){
		$this->init();
	}

	/**
	 * 
	 * @return Webmoney_WMID_WMIDList
	 */
	private function init(){		
		$this->wmidList = new Webmoney_WMID_WMIDList();
		foreach ($this->getXmlWmidList()->getNodeIterator() as $xmlWmid) {
			$this->wmidList->add($this->getWmidFromXml($xmlWmid));
		}
		return $this->wmidList;
	}
	
	/**
	 * 
	 * @return Webmoney_WMID_WMIDList
	 */
	public function getWmidList(){
		return $this->wmidList;
	}
	
	

	/**
	 *
	 * @param DOMElement $xmlWmid
	 * @return Webmoney_WMID_WMID
	 */
	private function getWmidFromXml(Application_AbstractComposite $xmlWmid){
		$wmid = new Webmoney_WMID_WMID($xmlWmid->getProperty('wmid'));
		$purses = $xmlWmid->getChildNode('Purses');		
		foreach ($purses->getPropertiesIterator() as $puseType => $purseNumber) {
			$purse = new Webmoney_Purse_Purse();
			$purse->setId($purseNumber);
			$purse->setNumber($purseNumber);
			$purse->setType($puseType);
			$purse->setWmid($wmid);
			
			$wmid->addPurse($purse);
		}
		return $wmid;
	}


	/**
	 * @return Application_AbstractComposite
	 */
	private function getXmlWmidList(){
		return Application_Registry::getConfig()->getChildNode('WMIDS');
	}
}