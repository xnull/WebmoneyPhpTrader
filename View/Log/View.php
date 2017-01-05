<?php
class View_Log_View extends View_View{

	protected function renderView(){
		include_once  View_View::getViewFolderPath() .'/Log/Template.php';
	}

	private function getLog(){
		$logList = $this->getVar('logList');
		//$logList = new Core_Collections_ArrayList();
		
		$result = null;
		
		for ($index = $logList->count()-1; $index >= 0; $index--) {
			$result .= $this->getLogRecord($logList->get($index)) . '<br>';
		}
		
		//foreach ($logList->iterator() as $record) {
			//$result .= $this->getLogRecord($record) . '<br>';
		//}
		
		if ($result == null) {
			$result = 'Записей нет!';
		}
		return $result;
	}
	
	private function getLogRecord(Log_Log $record){
		$result = $record->getDate();
		$result .= ': ' . $record->getMessage();
		return $result;	
	}

}

?>