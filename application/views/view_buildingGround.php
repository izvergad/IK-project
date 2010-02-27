<div id="mainview">			
    <div class="buildingDescription">
        <h1>Участок для постройки</h1>
        <p>Перед Вами находится обширный пустырь. Какое здание Вы хотите здесь построить?</p>
    </div>

    <div class="contentBox01h">
        <h3 class="header">Построить здание</h3>
        <div class="content">
            <ul id="buildings">


<?if ($position >= 1 and $position <= 2){?>

<?$building_id=2?>
<?$cost = $this->Data_Model->building_cost($building_id,0)?>

                <li class="building <?=$this->Data_Model->building_class_by_type($building_id)?>">
                    <div class="buildinginfo">
                        <h4><?=$this->Data_Model->building_name_by_type($building_id)?></h4>
                        <a href="/game/buildingDetail/<?=$building_id?>/"><img src="<?=$this->config->item('style_url')?>skin/buildings/y100/<?=$this->Data_Model->building_class_by_type($building_id)?>.gif" /></a>
                        <p><?=$this->Data_Model->building_desc_by_type($building_id)?></p>
                    </div>
                    <hr>
                    <div class="centerButton">
                        <a class="button build" style="padding-left:3px;padding-right:3px;" href="/actions/build/<?=$position?>/<?=$building_id?>/">
                            <span class="textLabel">Построить</span>
                        </a>
                    </div>
                    <div class="costs">
                        <h5>Стоимость:</h5>
                        <ul class="resources">
<?if($cost['wood'] > 0){?>
                            <li class="wood" title="Стройматериалы">
                                <span class="textLabel">Стройматериалы: </span><?=$cost['wood']?>
                            </li>
<?}?>
<?if($cost['wine'] > 0){?>
                            <li class="wine" title="Виноград">
                                <span class="textLabel">Виноград: </span><?=$cost['wine']?>
                            </li>
<?}?>
<?if($cost['marble'] > 0){?>
                            <li class="marble" title="Мрамор">
                                <span class="textLabel">Мрамор: </span><?=$cost['marble']?>
                            </li>
<?}?>
<?if($cost['crystal'] > 0){?>
                            <li class="crystal" title="Хрусталь">
                                <span class="textLabel">Хрусталь: </span><?=$cost['crystal']?>
                            </li>
<?}?>
<?if($cost['sulfur'] > 0){?>
                            <li class="sulfur" title="Сера">
                                <span class="textLabel">Сера: </span><?=$cost['sulfur']?>
                            </li>
<?}?>

                            <li class="time" title="Время постройки">
                                <span class="textLabel">Время постройки: </span><?=format_time($cost['time'])?>
                            </li>
                        </ul>
                    </div>
                </li>

<?}?>

			
            </ul>
        </div>
        <div class="footer"></div>
    </div>
</div>
 