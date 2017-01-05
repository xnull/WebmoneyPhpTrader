<br/>

<div style="border: 1px solid blue; width: 150px">
Скрипт: <font color="red"><?php echo $this->getCronStateHTML(); ?></font>
<div>
	<form method="get" action='index.php'>
		<input type="hidden" name="page" value="Main">
		<input type="hidden" name="action" value="<?php echo $this->getCronReverseState()?>">
		<input type='submit' value=<?php echo $this->cronAction()?>></input>
	</form> 
</div>
</div>

<br/>
<br/>

<h3>Выберите направление обменов</h3>
<form method="get" action="index.php">    
        <?php
			echo $this->exchListToHTML();
        ?>    
    <input type="submit" value="ОК">
</form>

<div style="margin-left: 50px">
	<div class="left">Ручное обновление курсов ЦБ</div>
	<div>
		<form method="get" action="index.php">
			<input type="hidden" name="action" value="refreshRates">
			<input type="hidden" name="direction" value="<?php echo $this->getVar('direction');?>">
			<input type="submit" value="Обновить">
		</form>
	</div>	
	<div class="left">Официальный курс: </div>	
	<div> <?php echo $this->officalRate();?> </div>
	
</div>

<form method="get" action="index.php">
<input type="hidden" name="page" value="Main">
<input type="hidden" name="action" value="save">	
<div style="margin-left: 50px">	
	<div class="left">Направление обмена: </div>
	<input type="hidden" name="direction" value="<?php echo $this->getVar('direction');?>">	
	<div>
	   <a href="https://wm.exchanger.ru/asp/XMLWMList.asp?exchtype=<?php echo $this->getExchType()?>"><?php echo $this->getVar('direction');?></a>
	</div>
		
	<div class="left">Дневной лимит (<?php echo $this->getWmSource();?>): </div>
	<div><?php echo $this->getDayLimit();?> Остаток дневного лимита: <?php echo $this->getDayLimitRemains();?> (<?php echo $this->getWmSource();?>)</div>
	
	<div class="left">Макс. сумма покупки(<?php echo $this->getWmSource()?>): </div>
	<div><?php echo $this->getMaxSumm();?> </div>
	
	<div class="left">Мин. сумма покупки(<?php echo $this->getWmSource()?>): </div>
	<div><?php echo $this->getMinSumm();?> </div>
	
	<div class="left">Итоговый курс для скупки: </div>
	<div><?php echo $this->myPersentResultRate() . ' мой процент: ' . $this->myPersent();?> %</div>

	<div  class="left">Бот: <font color="red"><?php echo $this->botState(); ?></font></div>
	<div><?php echo $this->botAction();?> </div>
	
	<br/>
	<div class="left"> &nbsp;</div>
	<div><input type="submit" value="сохранить"></input> </div> 
</div>
</form>

<br/>
<hr width="35%" align="left"></hr>
<br/>
Бот запущен по направлениям:
<?php 
	echo $this->getBotRunningDirections();
?>

