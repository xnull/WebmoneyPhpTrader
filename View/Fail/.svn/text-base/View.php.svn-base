<?php
class View_Fail_View extends View_View{

	protected function renderView(){
		include_once  View_View::getViewFolderPath() .'/Fail/Template.php';
	}

	private function getFail(){
		$failList = $this->getVar('failOperations');

		$result = null;

		for ($index = $failList->count()-1; $index >= 0; $index--) {
			$result .= $this->getFailRecord($failList->get($index)) . '<br>';
		}

		if ($result == null) {
			$result = 'Записей нет!';
		}
		return $result;
	}

	private function getFailRecord(Exchanger_OperationResult $record){
		$result = $record->getDate();
		$result .= ' retval:  ' . $record->getRetval();
		$result .= ' retDesc: ' . $record->getRetdesc();
		return $result;
	}

}

?>