<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
        <link rel="stylesheet" href="View/css/style.css" type="text/css"/>
        <title>Exchanger bot</title>
    </head>
    <body>
        <div>
            <a href="index.php">Главная</a>
            <a href="index.php?page=History">История операций</a>
            <a href="index.php?page=Log">Log</a>
            <a href="index.php?page=Fail">Fail</a>
            <a href="index.php?page=MyPays">MyPays</a>
            <a href="/Model/log.txt">Ошибки базы данных</a>
            <a href="index.php?page=base64">Base64</a>
            <a href="index.php?page=ConfigEditor">Редактировать конфиг</a>
        </div>
        <?php
        	$this->renderView();
        ?>
    </body>
</html>