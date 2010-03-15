<?$position = $param1?>
<?if ($position > 0){?>
}

<div id="mainview">

<?if ($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $position){?>
    <div class="buildingDescription">
        <h1 style="text-align:center">Академия</h1>
<?
    $level = ($this->Town_Model->buildings[$position] != false ) ? $this->Town_Model->buildings[$position]['level'] : 0;
    $cost = $this->Data_Model->building_cost($this->Town_Model->build_line[0]['type'], $level);
    $end_date = $this->Town_Model->build_start + $cost['time'];
    $ostalos = $end_date - time();
    $one_percent = ($cost['time']/100);
    $percent = 100 - floor($ostalos/$one_percent);

?>

    <div id="upgradeInProgress">
        <div class="isUpgrading">В процессе улучшения!</div>
        <div class="buildingLevel"><span class="textLabel">Уровень </span><?=$this->Town_Model->buildings[$position]['level']?></div>
        <div class="nextLevel"><span class="textLabel">след. уровень </span><?=$this->Town_Model->buildings[$position]['level']+1?></div>
        <div class="progressBar">
            <div class="bar" id="upgradeProgress" title="<?=$percent?>%" style="width:<?=$percent?>%;"></div>
            <a class="cancelUpgrade" href="<?=$this->config->item('base_url')?>actions/demolition/<?=$position?>/" title="Отменить"><span class="textLabel">Отменить</span></a>
        </div>

                                <script type="text/javascript">
				Event.onDOMReady(function() {
					var tmppbar = getProgressBar({
						startdate: <?=$this->Town_Model->build_start?>,
						enddate: <?=$end_date?>,
						currentdate: <?=time()?>,
						bar: "upgradeProgress"
						});
					tmppbar.subscribe("update", function(){
						this.barEl.title=this.progress+"%";
						});
					tmppbar.subscribe("finished", function(){
						this.barEl.title="100%";
						});
				});
				</script>


        <div class="time" id="upgradeCountDown"><?=format_time($ostalos)?></div>

                                <script type="text/javascript">
				Event.onDOMReady(function() {
					var tmpCnt = getCountdown({
						enddate: <?=$end_date?>,
						currentdate: <?=time()?>,
						el: "upgradeCountDown"
						}, 2, " ", "", true, true);
					tmpCnt.subscribe("finished", function() {
						setTimeout(function() {
							location.href="<?=$this->config->item('base_url')?>game/academy/<?=$position?>/";
							},2000);
						});
					});
				</script>

    </div>
    </div>
<?}else{?>
    <div class="buildingDescription">
        <h1>Академия</h1>
        <p>Академия - это источник мудрости, где древние знания применяются в сочетании с современными технологиями. Мудрейшие головы Вашего города толпятся у входа и ждут, когда наконец перед ними распахнутся двери! Но учтите, что каждый ученый нуждается в своей собственной лаборатории, которая стоит денег.
        Чем больше академия, тем больше ученых Вы можете использовать одновременно.</p>
    </div>
<?}?>

<?
$max_scientists = $this->Data_Model->scientists_by_level($this->Town_Model->buildings[$position]['level']);
$peoples = floor($this->Town_Model->peoples['free']);
$all = $this->Town_Model->peoples['free'] + $this->Town_Model->peoples['research'];
$max = ($max_scientists < $all) ? $max_scientists : $all;
$max = floor($max);

$plus_research = 1;
if ($this->User_Model->research->res3_2 > 0){$plus_research = $plus_research + 0.02;}
if ($this->User_Model->research->res3_5 > 0){$plus_research = $plus_research + 0.04;}
if ($this->User_Model->research->res3_11 > 0){$plus_research = $plus_research + 0.08;}
if ($this->User_Model->research->res3_16 > 0){$plus_research = $plus_research + (0.02*$this->User_Model->research->res3_16);}
$add_research = $this->Town_Model->peoples['research'] * $plus_research;

$gold_need = ($this->User_Model->research->res3_13 > 0) ? 6 : 9;

?>

    <form id="setScientists" action="<?=$this->config->item('base_url')?>actions/workers/academy/<?=$position?>/" method="POST">
        <div class="contentBox01h">
            <h3 class="header"><span class="textLabel">Назначить рабочих</span></h3>
            <div class="content">
                <ul>
                    <li class="citizens"><span class="textLabel">Граждане: </span><span class="value" id="valueCitizens"><?=$peoples?></span></li>
                    <li class="scientists"><span class="textLabel">Ученые: </span><span class="value" id="valueWorkers"><?=floor($this->Town_Model->peoples['research'])?></span></li>
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
                    <li class="costs"><span class="textLabel">Доход города: </span><span id="valueWorkCosts" class="negative"><?=floor($this->Town_Model->saldo)?></span> <img src="<?=$this->config->item('style_url')?>skin/resources/icon_gold.gif" title="Золото" alt="Золото" /><span class="timeUnit"> в час</span></li>
                </ul>
                <div id="overchargeMsg" class="status nooc ocready oced">Перегрузка!</div>
                <div class="slider" id="sliderbg">
                    <div class="actualValue" id="actualValue"></div>
                    <div class="overcharge" id="overcharge"></div>
                    <div id="sliderthumb"></div>
                </div>
                <a class="setMin" href="#reset" onClick="sliders['default'].setActualValue(0); return false;" title="Нет ученых"><span class="textLabel">мин.</span></a>
                <a class="setMax" href="#max" onClick="sliders['default'].setActualValue(<?=$max?>); return false;" title="макс. кол-во ученых"><span class="textLabel">макс.</span></a>
                <input type="hidden" name="cityId" value="83402">
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
            <img alt=" " src="<?=$this->config->item('style_url')?>skin/resources/icon_research.gif" class="iconResearch"> Баллы науки: <?=floor($this->User_Model->research->points)?>
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
        iniValue : <?=$this->Town_Model->peoples['research']?>,
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
        var startScientists = <?=$this->Town_Model->peoples['research']?>;
        var startIncomePerTimeUnit = <?=floor($this->Town_Model->saldo)?>;
        flagSliderMoved = 1;

        //res.setIcons(Math.round(slider.actualValue/(1+0.05*slider.actualValue)));
        Dom.get("valueWorkers").innerHTML = locaNumberFormat(slider.actualValue);
        Dom.get("valueCitizens").innerHTML = locaNumberFormat(startCitizens+startScientists - slider.actualValue);
        var valRes = <?=$plus_research?>*slider.actualValue;
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

<?}//position?>
