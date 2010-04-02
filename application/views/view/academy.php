<?if ($position == 0 and $page != 'townHall')
  {
    $this->Player_Model->Game_Error('Академия еще не построена!');
  }
?>
<div id="mainview">
<?include_once('building_description.php')?>
<?
$max_scientists = $this->Data_Model->scientists_by_level($level);
$peoples = floor($this->Player_Model->now_town->peoples);
$all = $this->Player_Model->now_town->peoples + $this->Player_Model->now_town->scientists;
$max = ($max_scientists < $all) ? $max_scientists : $all;
$max = floor($max);
$add_research = $this->Player_Model->now_town->scientists * $this->Player_Model->plus_research;
$gold_need = $this->Player_Model->scientists_gold_need;
?>
    <form id="setScientists" action="<?=$this->config->item('base_url')?>actions/workers/academy/<?=$position?>/" method="POST">
        <div class="contentBox01h">
            <h3 class="header"><span class="textLabel">Назначить рабочих</span></h3>
            <div class="content">
                <ul>
                    <li class="citizens"><span class="textLabel">Граждане: </span><span class="value" id="valueCitizens"><?=$peoples?></span></li>
                    <li class="scientists"><span class="textLabel">Ученые: </span><span class="value" id="valueWorkers"><?=floor($this->Player_Model->now_town->scientists)?></span></li>
                    <li class="gain">
                        <span class="textLabel">Научные достижения: </span>
                        <div id="gainPoints">
                            <img id="lightbulb" src="<?=$this->config->item('style_url')?>skin/layout/bulb-on.gif" width="14" height="21">
                        </div>
                        <div style="position:absolute; top:22px; left:145px;">
                            <span id="valueResearch" class="positive overcharged">+<?=floor($add_research)?></span>
                            <span class="timeUnit">в час</span>
                        </div>
                    </li>
                    <li class="costs"><span class="textLabel">Доход города: </span><span id="valueWorkCosts" class="negative"><?=floor($this->Player_Model->saldo[$this->Player_Model->town_id])?></span> <img src="<?=$this->config->item('style_url')?>skin/resources/icon_gold.gif" title="Золото" alt="Золото" /><span class="timeUnit"> в час</span></li>
                </ul>
                <div id="overchargeMsg" class="status nooc ocready oced">Перегрузка!</div>
                <div class="slider" id="sliderbg">
                    <div class="actualValue" id="actualValue"></div>
                    <div class="overcharge" id="overcharge"></div>
                    <div id="sliderthumb"></div>
                </div>
                <a class="setMin" href="#reset" onClick="sliders['default'].setActualValue(0); return false;" title="Нет ученых"><span class="textLabel">мин.</span></a>
                <a class="setMax" href="#max" onClick="sliders['default'].setActualValue(<?=$max?>); return false;" title="макс. кол-во ученых"><span class="textLabel">макс.</span></a>
                <input autocomplete="off" id="inputScientists" name="s" class="textfield" type="text" maxlength="4">
                <div class="centerButton">
                    <input type="submit" id="inputWorkersSubmit" class="button" value="Подтверждение">
                </div>
            </div>
            <div class="footer"></div>
        </div>
    </form>

    <div id="goToResearch" class="contentBox01h">
        <h3 class="header">Исследования</h3>
        <div class="centerButton">
            <img alt=" " src="<?=$this->config->item('style_url')?>skin/resources/icon_research.gif" class="iconResearch"> Баллы науки: <?=floor($this->Player_Model->research->points)?>
        </div>
        <div class="centerButton"><a class="button" href="<?=$this->config->item('base_url')?>game/researchAdvisor/">Советник по исследованиям</a></div>
        <div class="footer"></div>
    </div>
</div>

<script type="text/javascript">

	create_slider({
      id : "default",
        dir : 'ltr',
        maxValue : <?=$max?>,
        overcharge : 0,
        iniValue : <?=$this->Player_Model->now_town->scientists?>,
        bg : "sliderbg",
        thumb : "sliderthumb",
        topConstraint: -10,
        bottomConstraint: 344,
        bg_value : "actualValue",
        bg_overcharge : "overcharge",
        textfield:"inputScientists"
    });
Event.onDOMReady(function() {
    var resIconDisplay;
    var slider = sliders["default"];
    resIconDisplay = new resourceStack({
        container : "gainPoints",
        resourceicon : "lightbulb",
        width : 140
        });
    resIconDisplay.setIcons(Math.floor(slider.actualValue*1));
    var startSlider = slider.actualValue;
    slider.subscribe("valueChange", function() {
        resIconDisplay.setIcons(Math.floor(slider.actualValue*1));

        var startCitizens = <?=$peoples?>;
        var startScientists = <?=$this->Player_Model->now_town->scientists?>;
        var startIncomePerTimeUnit = <?=floor($this->Player_Model->saldo[$this->Player_Model->town_id])?>;
        flagSliderMoved = 1;

        //res.setIcons(Math.round(slider.actualValue/(1+0.05*slider.actualValue)));
        Dom.get("valueWorkers").innerHTML = locaNumberFormat(slider.actualValue);
        Dom.get("valueCitizens").innerHTML = locaNumberFormat(startCitizens+startScientists - slider.actualValue);
        var valRes = <?=$this->Player_Model->plus_research?>*slider.actualValue;
        Dom.get("valueResearch").innerHTML = '+' + Math.floor(valRes);
        Dom.get("valueWorkCosts").innerHTML = startIncomePerTimeUnit  - <?=$gold_need?>*(slider.actualValue-startSlider);
    });

    var flagSliderMoved =0;
    slider.subscribe("slideEnd", function() {
        if (flagSliderMoved) {
            Dom.get('inputWorkersSubmit').className = 'buttonChanged';
        }
     });
    });
</script>

