<?$type = ($this->Town_Model->buildings[$position]['type'] > 0) ? $this->Town_Model->buildings[$position]['type'] : 1?>

<div id="mainview">
		<h1><?=$this->Data_Model->building_name_by_type($type)?></h1>

	<div class="contentBox" id="demolition">
<?if ($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $position){?>
<?$cost = $this->Data_Model->building_cost($type,$this->Town_Model->buildings[$position]['level'], $this->User_Model->research)?>

		<h3 class="header">Подтвердить отмену улучшения</h3>
		<div class="content">
			<h4>Внимание</h4>
			<p>Вы уверены, что хотите прервать улучшение здания? Учтите, что будет возвращено 90% вложенных денег!</p>
			<p class="refund">При отмене Вы получите назад следующие ресурсы:
<?}else{?>
<?$cost = $this->Data_Model->building_cost($type,$this->Town_Model->buildings[$position]['level']-1, $this->User_Model->research)?>

                <h3 class="header">Подтвердить понижение уровня</h3>
		<div class="content">
			<h4>Внимание</h4>
			<p>Здание будет ухудшено на 1 уровень. При достижении 0 уровня здание будет уничтожено, место для строительства снова станет свободным. Вы получите только 90% вложенных средств.</p>
			<p>За снижениие уровня Вы получите назад следующие ресурсы:
<?}?>
			
                            <ul class="resources">
<?if($cost['wood'] > 0){?>
                                <li class="wood" title="Стройматериалы"><span class="textLabel">Стройматериалы: </span><?=floor($cost['wood']*0.9)?></li>
<?}?>
<?if($cost['marble'] > 0){?>
                                <li class="marble" title="Мрамор"><span class="textLabel">Мрамор: </span><?=floor($cost['marble']*0.9)?></li>
<?}?>
<?if($cost['wine'] > 0){?>
                                <li class="wine" title="Виноград"><span class="textLabel">Виноград: </span><?=floor($cost['wine']*0.9)?></li>
<?}?>
<?if($cost['crystal'] > 0){?>
                                <li class="glass" title="Хрусталь"><span class="textLabel">Хрусталь: </span><?=floor($cost['crystal']*0.9)?></li>
<?}?>
<?if($cost['sulfur'] > 0){?>
                                <li class="sulfur" title="Сера"><span class="textLabel">Сера: </span><?=floor($cost['sulfur']*0.9)?></li>
<?}?>

                            </ul>
                        </p>
			<hr>
			<a class="yes" href="<?=$this->config->item('base_url')?>actions/demolition/<?=$position?>/" title="Да">Да</a>
			<a class="no" href="<?=$this->config->item('base_url')?>game/<?=$this->Data_Model->building_class_by_type($type)?>/<?=$position?>/" title="Нет"><span class="textLabel">Нет</span></a>
		</div>
		<div class="footer"></div>
	</div>
</div>
