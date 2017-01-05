<?php
if (!defined('AllTests')) {
	include_once '../../__TestGlobals.php';
}


class UpdateTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testSelect() {
		$table = new ORM_SQL_Table('MyTable1');
		$table->addField(new ORM_SQL_Field('myField1', "filda1"));
		$table->addField(new ORM_SQL_Field('id', 123));
		
		$update = new ORM_SQL_Update($table);
		
		$this->assertEqual($update, 'UPDATE MyTable1 SET myField1=filda1 WHERE id=123', $update);

	}
}
?>
