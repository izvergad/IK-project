<?$position = $param1?>
<?if ($position == 0 and $location != 'townHall')
  {
    $this->User_Model->Game_Error('Верфь еще не построена!');
  }
?>

<?$level = isset($this->Town_Model->buildings[$position]['level']) ? $this->Town_Model->buildings[$position]['level'] : 0?>

<div id="mainview">

<?if ($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $position){?>
    <div class="buildingDescription">
        <h1 style="text-align:center">Верфь</h1>
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
							location.href="<?=$this->config->item('base_url')?>game/barracks/<?=$position?>/";
							},2000);
						});
					});
				</script>

    </div>
    </div>
<?}else{?>
    <div class="buildingDescription">
        <h1>Верфь</h1>
        <p>Чем была бы островная империя без флота? На верфи могучие боевые корабли готовятся для долгих путешествий по океанам. Пусть все семь морей дрожат перед ними! По мере улучшения верфи появляется возможность закладывать новые виды кораблей и скорость их постройки увеличивается.</p>
    </div>
<?}?>

    <form id="buildForm"  action="<?=$this->config->item('base_url')?>actions/fleet/<?=$position?>/" method="POST">
        <input type=hidden name="action" value="buildUnits">
        <div class="contentBox01h">
            <h3 class="header">Строить корабли</h3>
            <div class="content">

                <ul id="units">

<?for($i = 16; $i <= 22; $i++){?>
<?
    if (($i == 16) or
        ($i == 17 and $this->User_Model->research->res1_8 > 0) or
        ($i == 18 and $this->User_Model->research->res1_12 > 0) or
        ($i == 19 and $this->User_Model->research->res1_2 > 0) or
        ($i == 20 and $this->User_Model->research->res1_9 > 0) or
        ($i == 21 and $this->User_Model->research->res1_13 > 0) or
        ($i == 22 and $this->User_Model->research->res3_14 > 0)){
?>
<?
    $max_wood = 0;
    $max_sulfur = 0;
    $max_wine = 0;
    $max_crystal = 0;
    $max_peoples = 0;

    $cost = $this->Data_Model->army_cost_by_type($i);
    $class = $this->Data_Model->army_class_by_type($i);
    if ($cost['wood'] > 0){ $max_wood = floor($this->Town_Model->resources['wood']/$cost['wood']);}
    if ($cost['sulfur'] > 0){ $max_sulfur = floor($this->Town_Model->resources['sulfur']/$cost['sulfur']); }
    if ($cost['wine'] > 0){ $max_wine = floor($this->Town_Model->resources['wine']/$cost['wine']); }
    if ($cost['crystal'] > 0){ $max_crystal = floor($this->Town_Model->resources['crystal']/$cost['crystal']); }
    if ($cost['peoples'] > 0){ $max_peoples = floor($this->Town_Model->peoples['free']/$cost['peoples']); }

    $max = 999999;
    if ($cost['wood'] > 0){ $max = ($max_wood > $max) ? $max : $max_wood; }
    if ($cost['sulfur'] > 0){ $max = ($max_sulfur > $max) ? $max : $max_sulfur; }
    if ($cost['wine'] > 0){ $max = ($max_wine > $max) ? $max : $max_wine; }
    if ($cost['crystal'] > 0){ $max = ($max_crystal > $max) ? $max : $max_crystal; }
    if ($cost['peoples'] > 0){ $max = ($max_peoples > $max) ? $max : $max_peoples; }

?>



                    <li class="unit <?=$class?>">
                        <div class="unitinfo">
                            <h4><?=$this->Data_Model->army_name_by_type($i)?></h4>
                            <a title="К описанию <?=$this->Data_Model->army_name_by_type($i)?>" href="<?=$this->config->item('base_url')?>game/shipDescription/<?=$i?>">
                                <img src="<?=$this->config->item('style_url')?>skin/characters/fleet/120x100/<?=$class?>_r_120x100.gif">
                            </a>
                            <div class="unitcount"><span class="textLabel">Доступно: </span><?=$this->User_Model->armys[$this->Town_Model->id]->$class?></div>
                            <p><?=$this->Data_Model->army_desc_by_type($i)?></p>
                        </div>
                        <label for="textfield_<?=$class?>">Нанять <?=$this->Data_Model->army_name_by_type($i)?></label>
                        <div class="sliderinput">
                            <div class="sliderbg" id="sliderbg_<?=$class?>">
                                <div class="actualValue" id="actualValue_<?=$class?>"></div>
                                <div class="sliderthumb" id="sliderthumb_<?=$class?>"></div>
                            </div>

<script type="text/javascript">
    create_slider({
        dir : 'ltr',
        id : "slider_<?=$class?>",
        maxValue : <?=$max?>,
        overcharge : 0,
        iniValue : 0,
        bg : "sliderbg_<?=$class?>",
        thumb : "sliderthumb_<?=$class?>",
        topConstraint: -10,
        bottomConstraint: 326,
        bg_value : "actualValue_<?=$class?>",
        textfield:"textfield_<?=$class?>"
    });
    var slider = sliders["default"];
</script>

                            <a class="setMin" href="#reset" onClick="sliders['slider_<?=$this->Data_Model->army_class_by_type($i)?>'].setActualValue(0); return false;" title="Сбросить ввод"><span class="textLabel">мин.</span></a>
                            <a class="setMax" href="#max" onClick="sliders['slider_<?=$this->Data_Model->army_class_by_type($i)?>'].setActualValue(<?=$max?>); return false;" title="Рекрутировать максимум"><span class="textLabel">макс.</span></a>
			</div>

<?if ($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $position){?>
                        <div class="forminput">
                            Здание в процессе улучшения!
                        </div>
<?}else{?>
                        <div class="forminput">
                            <input class="textfield" id="textfield_<?=$this->Data_Model->army_class_by_type($i)?>" type="text" name="<?=$i?>"  value="0" size="4" maxlength="4">
                            <a class="setMax" href="#max" onClick="sliders['slider_<?=$this->Data_Model->army_class_by_type($i)?>'].setActualValue(<?=$max?>); return false;" title="Рекрутировать максимум">
                                <span class="textLabel">макс.</span>
                            </a>
                            <input class="button" type=submit value="нанять!">
                        </div>
<?}?>

                        <div class="costs">
                            <h5>Стоимость:</h5>
                            <ul class="resources">
<?if($cost['peoples'] > 0){?>
                                <li class="citizens" title="Граждане"><span class="textLabel">Граждане: </span><?=$cost['peoples']?></li>
<?}?>
<?if($cost['wood'] > 0){?>
                                <li class="wood" title="Стройматериалы"><span class="textLabel">Стройматериалы: </span><?=$cost['wood']?></li>
<?}?>
<?if($cost['sulfur'] > 0){?>
                                <li class="sulfur" title="Сера"><span class="textLabel">Сера: </span><?=$cost['sulfur']?></li>
<?}?>
<?if($cost['wine'] > 0){?>
                                <li class="wine" title="Виноград"><span class="textLabel">Виноград: </span><?=$cost['wine']?></li>
<?}?>
<?if($cost['crystal'] > 0){?>
                                <li class="glass" title="Хрусталь"><span class="textLabel">Хрусталь: </span><?=$cost['crystal']?></li>
<?}?>
<?if($cost['gold'] > 0){?>
                                <li class="upkeep" title="Содержание в час"><span class="textLabel">Содержание в час: </span><?=$cost['gold']?></li>
<?}?>
<?if($cost['time'] > 0){?>
                                <li class="time" title="Время постройки"><span class="textLabel">Время постройки: </span><?=format_time($cost['time'])?></li>
<?}?>
                            </ul>
                        </div>
                    </li>
<?}?>
<?}?>

				</ul>
			</div>
			<div class="footer"></div>
		</div>
		</form> <!-- End buildForm -->
	</div>