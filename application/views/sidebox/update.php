<?
if ($position > 0 or ($position == 0 and $page == 'townHall')){
    $level_text = 'pos'.$position.'_level';
    $type_text = 'pos'.$position.'_type';
    $class = $this->Player_Model->now_town->$type_text;
    $level = $this->Player_Model->now_town->$level_text;
    $cost = $this->Data_Model->building_cost($type, $level, $this->Player_Model->research);
?>

<div id="buildingUpgrade" class="dynamic">
    <h3 class="header">Улучшить
        <a class="help" href="<?=$this->config->item('base_url')?>game/buildingDetail/<?=$class?>/" title="Помощь">
            <span class="textLabel">Нужна помощь?</span>
        </a>
    </h3>
    <div class="content">
        <div class="buildingLevel"><span class="textLabel">Уровень </span><?=$level?></div>

        <h4>Необходим уровень <?=$level+1?>:</h4>

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
<?if(($this->Player_Model->now_town->build_line != '' and $this->Player_Model->user->premium_account == 0) or ($class == 5 and $this->Player_Model->armys[$this->Player_Model->town_id]->army_line != '')){?>
                <a class="disabled" href="#" title="Улучшение не доступно!"></a>
<?}else{?>
                <a href="<?=$this->config->item('base_url')?>actions/upgrade/<?=$position?>/" title="Повысить уровень"><span class="textLabel">Улучшение</span></a>
<?}?>
            </li>
            <li class="downgrade">
<?if (($this->Player_Model->now_town->build_line != '' and $this->Player_Model->build_line[$this->Player_Model->town_id][0]['position'] == $position) or
        ($position == 0) or
        ($class == 5 and $this->Player_Model->armys[$this->Player_Model->town_id]->army_line != '')){?>
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