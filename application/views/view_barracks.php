<?$position = $param1?>
<?if($position > 0){?>
}
<?$level = isset($this->Town_Model->buildings[$position]['level']) ? $this->Town_Model->buildings[$position]['level'] : 0?>

<div id="mainview">

<?if ($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $position){?>
    <div class="buildingDescription">
        <h1 style="text-align:center">Казарма</h1>
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
							location.href="<?=$this->config->item('base_url')?>game/barracks/<?=$position?>/";
							},2000);
						});
					});
				</script>

    </div>
    </div>
<?}else{?>
    <div class="buildingDescription">
        <h1>Казарма</h1>
        <p>В казарме буйная молодёжь проходит хорошую школу и превращается в смелых бойцов. Ваши солдаты умеют обращаться с мечами, копьями и катапультами, а также в состоянии самостоятельно управлять мощными боевыми машинами.
            По мере улучшения казармы появляется возможность найма новых видов войск и увеличивается скорость их обучения.</p>
    </div>
<?}?>

    <form id="buildForm"  action="<?=$this->config->item('base_url')?>actions/army/" method="POST">
        <input type=hidden name="action" value="buildUnits">
        <div class="contentBox01h">
            <h3 class="header">Нанять войска</h3>
            <div class="content">

                <ul id="units">

<?for($i = 1; $i <= 14; $i++){?>
<?
    if (($i == 1 and $level >= 4 and $this->User_Model->research->res4_3 > 0) or
        ($i == 2 and $level >= 12 and $this->User_Model->research->res4_12 > 0) or
        ($i == 3 and $level >= 1) or
        ($i == 4 and $level >= 6 and $this->User_Model->research->res4_3 > 0) or
        ($i == 5 and $level >= 2) or
        ($i == 6 and $level >= 7 and $this->User_Model->research->res4_6 > 0) or
        ($i == 7 and $level >= 13 and $this->User_Model->research->res4_11 > 0) or
        ($i == 8 and $level >= 3 and $this->User_Model->research->res4_4 > 0) or
        ($i == 9 and $level >= 8 and $this->User_Model->research->res4_7 > 0) or
        ($i == 10 and $level >= 14 and $this->User_Model->research->res4_13 > 0) or
        ($i == 11 and $level >= 10 and $this->User_Model->research->res3_12 > 0) or
        ($i == 12 and $level >= 11 and $this->User_Model->research->res3_15 > 0) or
        ($i == 13 and $level >= 5 and $this->User_Model->research->res2_9 > 0) or
        ($i == 14 and $level >= 9 and $this->User_Model->research->res3_8 > 0)){
?>
<?
    $max_wood = 0;
    $max_sulfur = 0;
    $max_wine = 0;
    $max_crystal = 0;
    $max_peoples = 0;
    
    $cost = $this->Data_Model->army_cost_by_type($i);
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



                    <li class="unit <?=$this->Data_Model->army_class_by_type($i)?>">
                        <div class="unitinfo">
                            <h4><?=$this->Data_Model->army_name_by_type($i)?></h4>
                            <a title="К описанию <?=$this->Data_Model->army_name_by_type($i)?>" href="<?=$this->config->item('base_url')?>game/unitDescription/<?=$i?>">
                                <img src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/<?=$this->Data_Model->army_class_by_type($i)?>_r_120x100.gif">
                            </a>
                            <div class="unitcount"><span class="textLabel">Доступно: </span>0</div>
                            <p><?=$this->Data_Model->army_desc_by_type($i)?></p>
                        </div>
                        <label for="textfield_<?=$this->Data_Model->army_class_by_type($i)?>">Нанять <?=$this->Data_Model->army_name_by_type($i)?></label>
                        <div class="sliderinput">
                            <div class="sliderbg" id="sliderbg_<?=$this->Data_Model->army_class_by_type($i)?>">
                                <div class="actualValue" id="actualValue_<?=$this->Data_Model->army_class_by_type($i)?>"></div>
                                <div class="sliderthumb" id="sliderthumb_<?=$this->Data_Model->army_class_by_type($i)?>"></div>
                            </div>

<script type="text/javascript">
    create_slider({
        dir : 'ltr',
        id : "slider_<?=$this->Data_Model->army_class_by_type($i)?>",
        maxValue : <?=$max?>,
        overcharge : 0,
        iniValue : 0,
        bg : "sliderbg_<?=$this->Data_Model->army_class_by_type($i)?>",
        thumb : "sliderthumb_<?=$this->Data_Model->army_class_by_type($i)?>",
        topConstraint: -10,
        bottomConstraint: 326,
        bg_value : "actualValue_<?=$this->Data_Model->army_class_by_type($i)?>",
        textfield:"textfield_<?=$this->Data_Model->army_class_by_type($i)?>"
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
<?}?>