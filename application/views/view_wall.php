<?$position = $param1?>
<?if ($this->Town_Model->buildings[14]['level'] == 0)
  {
    $this->User_Model->Game_Error('Стена еще не построена!');
  }
?>

<div id="mainview">

<?if ($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $position){?>
    <div class="buildingDescription">
        <h1 style="text-align:center">Городская стена</h1>
<?
    $level = ($this->Town_Model->buildings[$position] != false ) ? $this->Town_Model->buildings[$position]['level'] : 0;
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
							location.href="<?=$this->config->item('base_url')?>game/wall/<?=$position?>/";
							},2000);
						});
					});
				</script>

    </div>
    </div>
<?}else{?>
    <div class="buildingDescription">
        <h1>Городская стена</h1>
        <p>Городская стена защитит горожан и от солнца, и от врагов. Будьте острожны: враги попытаются проделать в ней бреши или перелезть через нее. Каждый уровень городской стены придаст вашим войскам бонус защиты в 10% .</p>
    </div>
<?}?>

    <div class="contentBox01h">
        <h3 class="header">Информация</h3>
        <div class="content">
        	<div class="bgWall">
        		<div id="wallInfoBox">
		        	<div class="infoBoxHeader"></div>
		        	<div class="infoBoxContent">
			        	<div class="weapon">
				        	<div class="weaponName">Атака местности</div>
				        	<span class="textLabel">Урон</span><b>12</b>
				        	<span class="textLabel">Точность</span>
				        	<div class="damageFocusContainer" title="30%">
				        		<div class="damageFocus" style="width: 30%;"></div>
				        	</div>
			        	</div>
			        	<span class="textLabel">Здоровье</span><b>150</b><br/>
			        	<span class="textLabel">Броня</span><b>15</b><br/>

			        	<span class="textLabel">Лимит гарнизона</span><b><?=number_format($this->Town_Model->garrison_limit)?></b><br/>
		        	</div>
		        	<div class="infoBoxFooter"></div>
	        	</div>
	        </div>
	    </div>
        <div class="footer"></div>
    </div>
    
</div>
