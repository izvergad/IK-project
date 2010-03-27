<?$position = $param1?>
<?if (($position == 0 and $location != 'townHall') or $this->Town_Model->buildings[$position]['type'] != 6)
  {
    $this->User_Model->Game_Error('Склад еще не построен!');
  }
?>

<?$level = isset($this->Town_Model->buildings[$position]['level']) ? $this->Town_Model->buildings[$position]['level'] : 0?>

<div id="mainview">
<?if ($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $position){?>
    <div class="buildingDescription">
        <h1 style="text-align:center">Склад</h1>
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
							location.href="<?=$this->config->item('base_url')?>game/warehouse/<?=$position?>/";
							},2000);
						});
					});
				</script>

    </div>
    </div>
<?}else{?>
    <div class="buildingDescription">
        <h1>Склад</h1>
        <p>Часть Ваших ресурсов хранится на складе, предлагая им отличную защиту от воров, а также от неблагоприятных погодных условий, птиц, мелкого зверья и прочих вредителей. Заведующий складом обладает детальной информацией о всех запасах. Улучшение склада позволит защитить большее количество ресурсов от внешних условий.</p>
    </div>
<?}?>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Товары на складе</span></h3>
        <div class="content">
            <p style="padding-top:10px;padding-left:18px;padding-right:10px;padding-bottom:0px;">
            </p>

<??>
<?
    $levels = 0;
    $levels_array = array();
    $warehouses = 0;
    for($i = 3; $i <= 13; $i++)
    {
        if ($this->Town_Model->buildings[$i]['type'] == 6)
        {
            $warehouses++;
            $levels = $levels + $this->Town_Model->buildings[$i]['level'];
            $levels_array[] = $this->Town_Model->buildings[$i]['level'];
        }
    }
    $safe = ($levels*80)+100;
    $nosafe_wood = (($this->Town_Model->resources['wood'] - $safe) < 0) ? 0 : ($this->Town_Model->resources['wood'] - $safe);
    $nosafe_wine = (($this->Town_Model->resources['wine'] - $safe) < 0) ? 0 : ($this->Town_Model->resources['wine'] - $safe);
    $nosafe_marble = (($this->Town_Model->resources['marble'] - $safe) < 0) ? 0 : ($this->Town_Model->resources['marble'] - $safe);
    $nosafe_crystal = (($this->Town_Model->resources['crystal'] - $safe) < 0) ? 0 : ($this->Town_Model->resources['crystal'] - $safe);
    $nosafe_sulfur = (($this->Town_Model->resources['sulfur'] - $safe) < 0) ? 0 : ($this->Town_Model->resources['sulfur'] - $safe);
    
    $capacity = ($levels*8000)+1500;
?>
<?if($warehouses > 1){?>
<p style="padding-top:10px;padding-left:18px;padding-right:10px;padding-bottom:0px;">
            В этом городе у Вас <?=$warehouses?> складов с уровнями <?for($i = 0; $i < SizeOf($levels_array); $i++){?><?=$levels_array[$i]?><?if(($i+1) != SizeOf($levels_array)){?>, <?}}?><br>
</p>
<?}?>
            <table class="table01">
                <thead>
                <tr>
                    <th>Застрахованные</th>
                    <th>Не застрахованные</th>
                    <th>Всего</th>
                    <th>Вместимость</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td class="sicher">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" title="Стройматериалы" alt="Стройматериалы"></td>
                                <td><span class="secure"><?=number_format($safe)?></span></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wine.gif" title="Виноград" alt="Виноград"></td>
                                <td><span class="secure"><?=number_format($safe)?></span></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_marble.gif" title="Мрамор" alt="Мрамор"></td>
                                <td><span class="secure"><?=number_format($safe)?></span></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_glass.gif" title="Хрусталь" alt="Хрусталь"></td>
                                <td><span class="secure"><?=number_format($safe)?></span></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_sulfur.gif" title="Сера" alt="Сера"></td>
                                <td><span class="secure"><?=number_format($safe)?></span></td>
                            </tr>
                        </table>
                    </td>
                    <td class="klaubar">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" title="Стройматериалы" alt="Стройматериалы"></td>
                                <td><span class="insecure"><?=number_format($nosafe_wood)?></span></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wine.gif" title="Виноград" alt="Виноград"></td>
                                <td><span class="insecure"><?=number_format($nosafe_wine)?></span></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_marble.gif" title="Мрамор" alt="Мрамор"></td>
                                <td><span class="insecure"><?=number_format($nosafe_marble)?></span></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_glass.gif" title="Хрусталь" alt="Хрусталь"></td>
                                <td><span class="insecure"><?=number_format($nosafe_crystal)?></span></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_sulfur.gif" title="Сера" alt="Сера"></td>
                                <td><span class="insecure"><?=number_format($nosafe_sulfur)?></span></td>
                            </tr>
                        </table>
                    </td>
                    <td class="gesamt">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" title="Стройматериалы" alt="Стройматериалы"></td>
                                <td><?=number_format($this->Town_Model->resources['wood'])?></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wine.gif" title="Виноград" alt="Виноград"></td>
                                <td><?=number_format($this->Town_Model->resources['wine'])?></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_marble.gif" title="Мрамор" alt="Мрамор"></td>
                                <td><?=number_format($this->Town_Model->resources['marble'])?></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_glass.gif" title="Хрусталь" alt="Хрусталь"></td>
                                <td><?=number_format($this->Town_Model->resources['crystal'])?></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_sulfur.gif" title="Сера" alt="Сера"></td>
                                <td><?=number_format($this->Town_Model->resources['sulfur'])?></td>
                            </tr>
                        </table>
                    </td>
                    <td class="capacity">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" title="Стройматериалы" alt="Стройматериалы"></td>
                                <td><?=number_format($capacity)?></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wine.gif" title="Виноград" alt="Виноград"></td>
                                <td><?=number_format($capacity)?></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_marble.gif" title="Мрамор" alt="Мрамор"></td>
                                <td><?=number_format($capacity)?></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_glass.gif" title="Хрусталь" alt="Хрусталь"></td>
                                <td><?=number_format($capacity)?></td>
                            </tr>
                            <tr>
                                <td><img src="<?=$this->config->item('style_url')?>skin/resources/icon_sulfur.gif" title="Сера" alt="Сера"></td>
                                <td><?=number_format($capacity)?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="footer"></div>
	</div>
</div>