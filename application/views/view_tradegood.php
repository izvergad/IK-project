<?if ($this->User_Model->research->res2_3 == 0){?>
<div id="mainview">

<?if($this->Island_Model->island->trade_resource == 1){?>
    <div class="buildingDescription"  style="background:url(skin/img/island/resource_wine.gif) no-repeat right 10px; min-height:180px;">
<?}elseif($this->Island_Model->island->trade_resource == 2){?>
    <div class="buildingDescription"  style="background:url(skin/img/island/resource_marble.gif) no-repeat right 10px; min-height:180px;">
<?}elseif($this->Island_Model->island->trade_resource == 3){?>
    <div class="buildingDescription"  style="background:url(skin/img/island/resource_glass.gif) no-repeat right 10px; min-height:180px;">
<?}elseif($this->Island_Model->island->trade_resource == 4){?>
    <div class="buildingDescription"  style="background:url(skin/img/island/resource_sulfur.gif) no-repeat right 10px; min-height:180px;">
<?}?>
        <h1><?=$this->Data_Model->island_building_by_resource($this->Island_Model->island->trade_resource)?></h1>
        <p>Для добычи этого ресурса вам необходимо исследовать Благосостояние!</p>
    </div>
</div>
<?}else{?>
<?
    $cost = $this->Data_Model->island_cost($this->Island_Model->island->trade_resource, $this->Island_Model->levels[1]-1);
    $peoples = floor($this->Town_Model->peoples['free']);
    $all = $this->Town_Model->peoples['free'] + $this->Town_Model->peoples['special'];
    $max = ($cost['workers'] < $all) ? $cost['workers'] : $all;
    $max = floor($max);
?>

<div id="mainview">
    <div class="buildingDescription">
        <h1><?=$this->Data_Model->island_building_by_resource($this->Island_Model->island->trade_resource)?></h1>
        <p></p>
    </div>

    <form id="setWorkers" action="<?=$this->config->item('base_url')?>actions/workers/tradegood/<?=$this->Island_Model->island->id?>"  method="POST">
        <div id="setWorkersBox" class="contentBox">
            <h3 class="header"><span class="textLabel">Назначить рабочих</span></h3>
            <div class="content">
                <ul>
                    <li class="citizens"><span class="textLabel">Граждане: </span><span class="value" id="valueCitizens"><?=$peoples?></span></li>
                    <li class="workers"><span class="textLabel">Работников: </span><span class="value" id="valueWorkers"><?=floor($this->Town_Model->peoples['special'])?></span></li>
                    <li class="gain" title="Производство:<?=floor($this->Town_Model->peoples['special'])?>" alt="Производство:<?=floor($this->Town_Model->peoples['special'])?>">
                        <span class="textLabel">Вместимость: </span>
                        <div id="gainPoints">
                            <div id="resiconcontainer">
  <?switch($this->Island_Model->island->trade_resource){?>
<?case 1:?>
        <img id="resicon" src="<?=$this->config->item('style_url')?>skin/resources/icon_wine.gif" width="25" height="20">
<?break;?>
<?case 2:?>
        <img id="resicon" src="<?=$this->config->item('style_url')?>skin/resources/icon_marble.gif" width="25" height="20">
<?break;?>
<?case 3:?>
        <img id="resicon" src="<?=$this->config->item('style_url')?>skin/resources/icon_glass.gif" width="25" height="20">
<?break;?>
<?case 4:?>
        <img id="resicon" src="<?=$this->config->item('style_url')?>skin/resources/icon_sulfur.gif" width="25" height="20">
<?break;?>
<?}?>
                            </div>
                        </div>
                        <div class="gainPerHour">
                            <span id="valueResource" >+<?=floor($this->Town_Model->peoples['special'])?></span> <span class="timeUnit">в час</span>
                        </div>
                    </li>
                    <li class="costs">
                        <span class="textLabel">Доход города: </span>
                        <span id="valueWorkCosts" class="negative"><?=floor($this->Town_Model->saldo)?></span>
                        <img src="<?=$this->config->item('style_url')?>skin/resources/icon_gold.gif" title="Золото" alt="Золото">
                        <span class="timeUnit"> в час</span>
                    </li>
                </ul>
                <div id="overchargeMsg" class="status nooc ocready oced">Перегрузка!</div>
                <div class="slider" id="sliderbg">
                    <div class="actualValue" id="actualValue"></div>
                    <div class="overcharge" id="overcharge"></div>
                    <div id="sliderthumb"></div>
                </div>
                <a class="setMin" href="#reset" onClick="sliders['default'].setActualValue(0); return false;" title="нет рабочих"><span class="textLabel">мин.</span></a>
                <a class="setMax" href="#max" onClick="sliders['default'].setActualValue(<?=$max?>); return false;" title="макс. число рабочих"><span class="textLabel">макс.</span></a>

                <input class="textfield" id="inputWorkers" type="text" name="tw" maxlength="4" autocomplete="off">
                <input class="button" id="inputWorkersSubmit" type="submit" value="Подтверждение">
            </div>
            <div class="footer"></div>
        </div>
    </form>

    <div id="resourceUsers" class="contentBox">
        <h3 class="header"><span class="textLabel">Другие игроки на этом острове</span></h3>
        <div class="content">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>Игрок                        </th>
                        <th>Город                    </th>
                        <th>Уровень                    </th>
                        <th>Работников                    </th>
                        <th>Пожертвовано                        </th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>

<? for ($i = 0; $i <= 15; $i++){?>
<?if (isset($this->Island_Model->towns[$i])){?>
    <?if($this->User_Model->id != $this->Island_Model->users[$i]->id){?>
    <tr class="alt avatar ">
    <?}else{?>
    <tr class="alt own avatar ">
    <?}?>
        <td class="ownerName"><?=$this->Island_Model->users[$i]->login?></td>
        <td class="cityName"><?=$this->Island_Model->towns[$i]->name?></td>
        <td class="cityLevel">Уровень <?=$this->Island_Model->towns[$i]->pos0_level?></td>
        <td class="cityWorkers"><?=$this->Island_Model->towns[$i]->tradegood?> Работников</td>
        <td class="ownerDonation"><?=$this->Island_Model->towns[$i]->tradegood_wood?> <img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" width="25" height="20" alt="Стройматериалы" /></td>
        <?if($this->User_Model->id != $this->Island_Model->users[$i]->id){?>
        <td class="actions"><a href="<?=$this->config->item('base_url')?>game/sendIKMessage/<?=$this->Island_Model->towns[$i]->user?>/"><img src="<?=$this->config->item('style_url')?>skin/interface/icon_message_write.gif" alt="Создать сообщение" /></a></td>
        <?}?>
    </tr>
<?}?>
<?}?>

                </tbody>
            </table>
        </div>
        <div class="footer"></div>
    </div>
</div>

<script type="text/javascript">
    create_slider({
        dir : 'ltr',
        id : "default",
        maxValue : <?=floor($max)?>,
        overcharge : 0,
        iniValue : <?=floor($this->Town_Model->peoples['special'])?>,
        bg : "sliderbg",
        thumb : "sliderthumb",
        topConstraint: -10,
        bottomConstraint: 344,
        bg_value : "actualValue",
        bg_overcharge : "overcharge",
        textfield:"inputWorkers"
    });
    Event.onDOMReady(function() {
	var slider = sliders["default"];
        var res = new resourceStack({
            container : "resiconcontainer",
            resourceicon : "resicon",
            width : 140
        });
        res.setIcons(Math.floor(slider.actualValue/(1+0.05*slider.actualValue)));
        slider.subscribe("valueChange", function() {
            res.setIcons(Math.floor(slider.actualValue/(1+0.05*slider.actualValue)));
        });
        var startSlider = slider.actualValue;
        var valueWorkers = Dom.get("valueWorkers");
        var valueCitizens = Dom.get("valueCitizens");
        var valueResource = Dom.get("valueResource");
        var valueWorkCosts = Dom.get("valueWorkCosts");
        var inputWorkersSubmit = Dom.get("inputWorkersSubmit");
        slider.flagSliderMoved =0;
        slider.subscribe("valueChange", function() {
            var startCitizens = <?=floor($this->Town_Model->peoples['free'])?>;
            var startResourceWorkers = <?=floor($this->Town_Model->peoples['special'])?>;
            var startIncomePerTimeUnit = <?=floor($this->Town_Model->saldo)?>;
            this.flagSliderMoved = 1;
            valueWorkers.innerHTML = locaNumberFormat(slider.actualValue);
            valueCitizens.innerHTML = locaNumberFormat(startCitizens+startResourceWorkers - slider.actualValue);
            var valRes = 1 * 1 * (Math.min(<?=$cost['workers']?>, slider.actualValue) + Math.max(0, 0.25 * (slider.actualValue-<?=$cost['workers']?>)));
            valueResource.innerHTML = '+' + Math.floor(valRes);
            valueWorkCosts.innerHTML = startIncomePerTimeUnit  - 3*(slider.actualValue-startSlider);
        });
        slider.subscribe("slideEnd", function() {
            if (this.flagSliderMoved) {
                inputWorkersSubmit.className = 'buttonChanged';
            }
        });
    });
</script>
<?}?>