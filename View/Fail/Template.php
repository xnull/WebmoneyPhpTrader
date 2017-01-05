<br/>
<h3>Журнал неуспешных операций</h3>

<form method="get" action="index.php">
	<input type="hidden" name="page" value="Fail">
	<input type="hidden" name="action" value="clear"></input>
	<input type="submit" value="Очистить">
</form>

<?php
echo $this->getFail();
?>


