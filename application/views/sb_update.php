<?
if ($position > 0 or ($position == 0 and $location == 'townHall')){
    $cost = $this->Data_Model->building_cost($type,$this->Town_Model->buildings[$position]['level']);
?>

<div id="buildingUpgrade" class="dynamic">
    <h3 class="header">Улучшить
        <a class="help" href="<?=$this->config->item('base_url')?>game/buildingDetail/<?=$this->Town_Model->buildings[$position]['type']?>/" title="Помощь">
            <span class="textLabel">Нужна помощь?</span>
        </a>
    </h3>
    <div class="content">
        <div class="buildingLevel"><span class="textLabel">Уровень </span><?=$this->Town_Model->buildings[$position]['level']?></div>

        <h4>Необходим уровень <?=$this->Town_Model->buildings[$position]['level']+1?>:</h4>

        <ul class="resources">
<?if($cost['wood'] > 0){?>
            <li class="wood" title="Стройматериалы"><span class="textLabel">Стройматериалы: </span><?=number_format($cost['wood'])?></li>
<?}?>
<?if($cost['wine'] > 0){?>
            <li class="wine" title="Виноград"><span class="textLabel">Виноград: </span><?=number_format($cost['wine'])?></li>
<?}?>
<?if($cost['marble'] > 0){?>
            <li class="marble" title="Мрамор"><span class="textLabel">Мрамор: </span><?=number_format($cost['marble'])?></li>
<?}?>
<?if($cost['crystal'] > 0){?>
            <li class="glass" title="Хрусталь"><span class="textLabel">Хрусталь: </span><?=number_format($cost['crystal'])?></li>
<?}?>
<?if($cost['sulfur'] > 0){?>
            <li class="sulfur" title="Сера"><span class="textLabel">Сера: </span><?=number_format($cost['sulfur'])?></li>
<?}?>
<?if($cost['time'] > 0){?>
            <li class="time" title="Время постройки"><span class="textLabel">Время постройки: </span><?=format_time($cost['time'])?></li>
<?}?>
        </ul>
        <ul class="actions">
            <li class="upgrade">
<?if(($this->Town_Model->build_text != '' and $this->User_Model->premium_account == 0) or ($this->Town_Model->buildings[$position]['type'] == 5 and $this->User_Model->armys[$this->Town_Model->id]->army_line != '')){?>
                <a class="disabled" href="#" title="Улучшение не доступно!"></a>
<?}else{?>
                <a href="<?=$this->config->item('base_url')?>actions/upgrade/<?=$position?>/" title="Повысить уровень"><span class="textLabel">Улучшение</span></a>
<?}?>
            </li>
            <li class="downgrade">
<?if (($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $position) or 
        ($position == 0) or
        ($this->Town_Model->buildings[$position]['type'] == 5 and $this->User_Model->armys[$this->Town_Model->id]->army_line != '')){?>
                <a class="disabled" href="#" title="Невозможно разрушить в данный момент!"></a>
<?}else{?>
                <a href="<?=$this->config->item('base_url')?>game/demolition/<?=$position?>/" title="Понизить уровень"><span class="textLabel">Снести</span></a>
<?}?>
            </li>
	</ul>
    </div>
    <div class="footer"></div>
</div>
<?}?>