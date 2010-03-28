<?$position = $param1?>
<?if ($position == 0 and $location != 'townHall')
  {
    $this->User_Model->Game_Error('Таверна еще не построена!');
  }
?>

<script>

classValuePerSatisfaction = new Array();
classNamePerSatisfaction = new Array();
classValuePerSatisfaction[0] = 300;
classNamePerSatisfaction[0] = 'ecstatic';
classValuePerSatisfaction[1] = 50;
classNamePerSatisfaction[1] = 'happy';
classValuePerSatisfaction[2] = 0;
classNamePerSatisfaction[2] = 'neutral';
classValuePerSatisfaction[3] = -50;
classNamePerSatisfaction[3] = 'sad';
classValuePerSatisfaction[4] = -1000;
classNamePerSatisfaction[4] = 'outraged';

satPerWine = new Array();

savedWine = new Array();
<?$level = ($this->Town_Model->buildings[$position] != false ) ? $this->Town_Model->buildings[$position]['level'] : 0?>

<?for($i = 0; $i <= $level; $i++){?>
	satPerWine[<?=$i?>] = <?=$i*60?>;
	savedWine[<?=$i?>] = '&nbsp;';
<?}?>

</script>

<div id="mainview">
<?if ($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $position){?>
    <div class="buildingDescription">
        <h1 style="text-align:center">Таверна</h1>
<?
    $cost = $this->Data_Model->building_cost($this->Town_Model->build_line[0]['type'], $level, $this->User_Model->research);
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
            <a class="cancelUpgrade" href="<?=$this->config->item('base_url')?>game/demolition/<?=$position?>/" title="Отменить"><span class="textLabel">Отменить</span></a>
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
							location.href="<?=$this->config->item('base_url')?>game/tavern/<?=$position?>/";
							},2000);
						});
					});
				</script>

    </div>
    </div>
<?}else{?>
    <div class="buildingDescription">
        <h1>Таверна</h1>
        <p>После окончания работы нет ничего более приятного, чем кувшин вина - поэтому таверна считается очень популярным местом среди Ваших граждан. Улучшив настроение приятной порцией вина, они начинают петь песни, символизируя таким образом конец трудового дня. Каждое улучшение таверны позволяет Вам разливать больше вина для утомившихся граждан.</p>
    </div>
<?}?>


    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Приготовить напитки</span></h3>
        <div class="content">
            <form id="wineAssignForm" action="<?=$this->config->item('base_url')?>actions/tavern/<?=$position?>/" method="POST">

                <ul id="units">
                    <li class="unit">
                        <div class="unitinfo">
                            <h4>Приготовить вино</h4>
                            <img src="<?=$this->config->item('style_url')?>skin/resources/wine-big.gif" style="margin-left:10px;">
                            <p>Вы можете указать количество затрачиваемого винограда на приготовление вина. Чем больше винограда, тем больше вина и тем довольнее граждане.
                                Внимание: тавернщик получает часовую норму винограда при каждой смене нормировки!</p>
                        </div>

                        <div class="sliderinput">
                    
                            <div id="sliderbg_wine" class="sliderbg" title="slider value = 0">
                                <div id="actualValue_wine" class="actualValue" style="clip: rect(0px, 10px, auto, 0px);"></div>
                                <div id="sliderthumb_wine" class="sliderthumb" style="left: 0px; top: 0px;"></div>
                            </div>

                <script type="text/javascript">
                create_slider({
                        dir : 'ltr',
                        id : "slider_wine",
                        maxValue : <?=$level?>,
                        overcharge : 0,
                        iniValue : <?=$this->Town_Model->tavern_wine?>,
                        bg : "sliderbg_wine",
                        thumb : "sliderthumb_wine",
                        topConstraint: -10,
                        bottomConstraint: 326,
                        bg_value : "actualValue_wine",
                        textfield:"wineAmount"
                    });
                Event.onDOMReady(function() {
					var slider = sliders["slider_wine"];
                    var startSatisfaction = <?=$this->Town_Model->good?>;
                    slider.subscribe("valueChange", function() {
                        var val = classValuePerSatisfaction.length-1;
                        for (n=0;n<5;n++) {
                            if (classValuePerSatisfaction[n] <= (startSatisfaction + 60*slider.actualValue)) {
                                val = n;
                                break;
                            }
                        }
                        window.status = startSatisfaction + 60*slider.actualValue;
                        Dom.get('citySatisfaction').className = classNamePerSatisfaction[val];
                        if(satPerWine[slider.actualValue]) {
                            slider.UpdateField1.innerHTML = satPerWine[slider.actualValue];
                            slider.UpdateField2.innerHTML = savedWine[slider.actualValue];
                        } else {
                            slider.UpdateField1.innerHTML = "0";
                            slider.UpdateField2.innerHTML = "&nbsp;"

                        }
                    });
					slider.UpdateField1 = Dom.get("bonus");
                    slider.UpdateField1.innerHTML = satPerWine[slider.actualValue];
					slider.UpdateField2 = Dom.get("savedWine");
                    slider.UpdateField2.innerHTML = savedWine[slider.actualValue];
				});
                </script>

                            <a class="setMin" href="#reset" onClick="sliders['slider_wine'].setActualValue(0); return false;" title="Сбросить ввод"><span class="textLabel">мин.</span></a>
                            <a class="setMax" href="#max" onClick="sliders['slider_wine'].setActualValue(<?=$this->Data_Model->wine_by_tavern_level($level)?>); return false;" title="Приготовить максимум"><span class="textLabel">макс.</span></a>                </div><!-- end .sliderinput -->
          
                            <div class="forminput">
                                <a title="Приготовить максимум" onclick="sliders['slider_wine'].setActualValue(1); return false;" href="#max" class="setMax"><span class="textLabel">макс.</span></a>
                                <div class="centerButton">
                                    <input type="submit" value="Ваше здоровье!" class="button">
                                </div>
                                <div id="citySatisfaction"  class="<?=$this->Data_Model->good_class_by_count($this->Town_Model->good)?>">
                                </div>
                            </div>
                    
                            <div id="serve" class="textfield">
                                <select id="wineAmount" name="amount" size="1">
                                    
<?for($i = 0; $i <= $level; $i++){?>
<?if ($i == 0){?>
                                    <option value="0" <?if($this->Town_Model->tavern_wine == $i){?>selected<?}?>>Нет винограда</option>
<?}else{?>
                                    <option value="<?=$i?>" <?if($this->Town_Model->tavern_wine == $i){?>selected<?}?>><?=$this->Data_Model->wine_by_tavern_level($i)?> Винограда в час </option>
<?}}?>
                                </select>
                                
                                <span class="bonus">+<span id="bonus" class="value">0</span> довольные граждане</span>
                                <br>
                                <span class="savedWine"><span id="savedWine"></span></span>
                            </div>
                            <!--
					<div class="satisfaction"><span>Уровень довольства в данный момент:</span> <?=$this->Town_Model->good?></div>
                            -->
                    </li>
                </ul>
            </form>
        </div>
        <div class="footer"></div>
    </div>

</div>
