<html>
<head>
<meta content="text/html; charset=windows-1251"
	http-equiv="Content-Type">
</head>
<body>
<?php

$pathToLoader = realpath(dirname(__FILE__) . '/../Core/Loader.php');
include_once $pathToLoader;

$db = Application_Registry::getDataBase();
$db->execute('delete from log');
$text = '���2'; //iconv('windows-1251', 'utf-8', '�� ���');
$db->execute('INSERT INTO log values (12345, "' . $text . '", "2010-01-12 05:00:00")');
?>
</body>
</html>
