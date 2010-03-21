<?$position = $param1?>
<div id="mainview">			
    <div class="buildingDescription">
        <h1>Участок для постройки</h1>
        <p>Перед Вами находится обширный пустырь. Какое здание Вы хотите здесь построить?</p>
    </div>

    <div class="contentBox01h">
        <h3 class="header">Построить здание</h3>
        <div class="content">
            <ul id="buildings">

<?$buildings_count = 0?>

<?for ($i = 2; $i <= 26; $i++){?>
<?if ($this->Town_Model->already_build[$i] == false){?>

<?if ($i != 7 and $position == 14){ continue; }?>
<?if (($i != 4 and $i != 2) and ($position == 1 or $position ==2)){ continue; }?>
<?if (($i == 4 or $i == 2 or $i == 7) and ($position >2 and $position < 14)){ continue; }?>

<?
    if (($i == 4 and $this->User_Model->research->res4_1 == 0) or
        ($i == 6 and $this->User_Model->research->res2_1 == 0) or
        ($i == 8 and $this->User_Model->research->res2_4 == 0) or
        ($i == 9 and $this->User_Model->research->res3_7 == 0) or
        ($i == 10 and $this->User_Model->research->res1_4 == 0) or
        ($i == 11 and $this->User_Model->research->res1_5 == 0) or
        ($i == 12 and $this->User_Model->research->res2_3 == 0) or
        ($i == 13 and $this->User_Model->research->res3_6 == 0) or
        ($i == 14 and $this->User_Model->research->res3_3 == 0) or
        ($i == 15 and $this->User_Model->research->res1_4 == 0) or
        ($i == 16 and $this->User_Model->research->res2_5 == 0) or
        ($i == 17 and $this->User_Model->research->res2_5 == 0) or
        ($i == 18 and $this->User_Model->research->res2_5 == 0) or
        ($i == 19 and $this->User_Model->research->res2_5 == 0) or
        ($i == 20 and $this->User_Model->research->res2_5 == 0) or
        ($i == 21 and $this->User_Model->research->res1_1 == 0) or
        ($i == 22 and $this->User_Model->research->res2_7 == 0) or
        ($i == 23 and $this->User_Model->research->res3_9 == 0) or
        ($i == 24 and $this->User_Model->research->res2_12 == 0) or
        ($i == 25 and $this->User_Model->research->res4_10 == 0) or
        ($i == 26 and $this->User_Model->research->res3_4 == 0)){ continue; }
?>

<?$buildings_count++?>
<?$building_id=$i?>
<?$cost = $this->Data_Model->building_cost($building_id,0)?>

                <li class="building <?=$this->Data_Model->building_class_by_type($building_id)?>">
                    <div class="buildinginfo">
                        <h4><?=$this->Data_Model->building_name_by_type($building_id)?></h4>
                        <a href="<?=$this->config->item('base_url')?>game/buildingDetail/<?=$building_id?>/"><img src="<?=$this->config->item('style_url')?>skin/buildings/y100/<?=$this->Data_Model->building_class_by_type($building_id)?>.gif" /></a>
                        <p><?=$this->Data_Model->building_desc_by_type($building_id)?></p>
                    </div>
                    <hr>
<?if ($this->Town_Model->resources['wood'] < $cost['wood'] or
        $this->Town_Model->resources['wine'] < $cost['wine'] or
        $this->Town_Model->resources['marble'] < $cost['marble'] or
        $this->Town_Model->resources['crystal'] < $cost['crystal'] or
      $this->Town_Model->resources['sulfur'] < $cost['sulfur']){?>
 <p class="cannotbuild">Недостаточно ресурсов!</p>
 <?}else{?>
<?if($this->Town_Model->build_text == ''){?>
                    <div class="centerButton">
                        <a class="button build" style="padding-left:3px;padding-right:3px;" href="<?=$this->config->item('base_url')?>actions/build/<?=$position?>/<?=$building_id?>/">
                            <span class="textLabel">Построить</span>
                        </a>
                    </div>
<?}else{?>
<?if($this->User_Model->premium_account > 0){?>
                    <div class="centerButton">
                        <a class="button build" style="padding-left:3px;padding-right:3px;" href="<?=$this->config->item('base_url')?>actions/build/<?=$position?>/<?=$building_id?>/">
                            <span class="textLabel">В очередь</span>
                        </a>
                    </div>
<?}else{?>
    <p class="cannotbuild">Уже имеется строящееся или улучшаемое здание. (<a href="<?=$this->config->item('base_url')?>game/premiumDetails/">Поместить в очередь на постройку?</a>)</p>
<?}?>
<?}?>
<?}?>
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
<?}?>
            </ul>
<?if($buildings_count == 0){?>
<div><br><center><p>Невозможно построить новые здания.</p></center></div>
<?}?>

        </div>
        <div class="footer"></div>
    </div>
</div>
 