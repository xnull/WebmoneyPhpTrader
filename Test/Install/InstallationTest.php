<?php
include_once '../__TestGlobals.php';


class InstallationTest extends UnitTestCase {
	function __construct(){
		$this->UnitTestCase();
	}

	function testInstall() {
		$install = new Install_Installation();
	}
}

?>
