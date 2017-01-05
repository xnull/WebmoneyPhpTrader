<br/>
<h3>Редактирование конфига</h3>

<form action="" method="post">
<input type="hidden" name="page" value="ConfigEditor">
<input type="hidden" name="action" value="edit">
<textarea name="newConfig" cols="100" rows="30">
<?php
echo $this->getConfig();
?>
</textarea>
<br/>
<input type="submit" value="Сохранить"></input>
</form>