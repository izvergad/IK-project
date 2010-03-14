<?
if ($position >= 0){
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
            <li class="crystal" title="Хрусталь"><span class="textLabel">Хрусталь: </span><?=number_format($cost['crystal'])?></li>
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
                <a href="<?=$this->config->item('base_url')?>actions/upgrade/<?=$position?>/" title="Повысить уровень"><span class="textLabel">Улучшение</span></a>
            </li>
            <li class="downgrade">
                <a href="<?=$this->config->item('base_url')?>actions/demolitions/<?=$position?>/" title="Понизить уровень"><span class="textLabel">Снести</span></a>
            </li>
	</ul>
    </div>
    <div class="footer"></div>
</div>
<?}?>