<?php
if (!defined('AllTests')) {
	include_once '../../__TestGlobals.php';
}


class SqlTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testSelect() {
		$select = new ORM_SQL_Select();

		$table = new ORM_SQL_Table('MyTable1');
		$table->addField(new ORM_SQL_Field('myField1'));

		$table2 = new ORM_SQL_Table('MyTable2');
		$table2->addField(new ORM_SQL_Field('myField1'));

		$select->addTable($table);
		$select->addTable($table2);

		$this->assertEqual($select, 'SELECT MyTable1.myField1, MyTable2.myField1 FROM MyTable1, MyTable2 ', $select);

	}

	public function testInsert(){
		$table = new ORM_SQL_Table('MyTable');
		$field1 = new ORM_SQL_Field('myField1', '123');
		$table->addField($field1);

		$insert = new ORM_SQL_Insert($table);

		$this->assertEqual($insert, 'INSERT IGNORE INTO MyTable (myField1) VALUES (123)', $insert);
	}

	public function testWhere(){
		$field = new ORM_SQL_Field('id', '123');
		$criterion = new ORM_SQL_Criterion($field, '=');
		$criterion2 = new ORM_SQL_Criterion($field, '=');
		$criterion3 = new ORM_SQL_Criterion($field, '=');

		$where = new ORM_SQL_Where($criterion);
		$where->addAND($criterion2);
		$where->addOR($criterion3);

		$this->assertEqual($where, 'WHERE ( id="123" AND id="123" OR id="123" )', $where);
	}
}
?>
