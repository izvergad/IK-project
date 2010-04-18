<?
    $type_text = 'pos'.$position.'_type';
    $level_text = 'pos'.$position.'_level';
    $type = $this->Player_Model->now_town->$type_text;
    $level = $this->Player_Model->now_town->$level_text;
?>

<?if ($this->Player_Model->now_town->build_line != '' and $this->Player_Model->build_line[$this->Player_Model->town_id][0]['position'] == $position){?>
<?
    $cost = $this->Data_Model->building_cost($type, $level, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->town_id]);
    $end_date = $this->Player_Model->now_town->build_start + $cost['time'];
    $ostalos = $end_date - time();
    $one_percent = ($cost['time']/100);
    $percent = 100 - floor($ostalos/$one_percent);
?>

<div id="buildingUpgrade" class="dynamic upgrading">
    <h3 class="header">Улучшение <a class="help" href="<?=$this->config->item('base_url')?>game/buildingDetail/<?=$type?>/" title="Помощь"><span class="textLabel">Нужна помощь?</span></a></h3>
    <div class="content">
        <div class="isUpgrading">В процессе улучшения!</div>
        <div class="buildingLevel"><span class="textLabel">Уровень </span><?=$level?></div>
        <div class="nextLevel"><span class="textLabel">след. уровень </span><?=$level+1?></div>

        <div class="progressBar"><div class="bar" id="upgradeProgress" title="<?=$percent?>%" style="width:<?=$percent?>%;"></div></div>
			<script type="text/javascript">
			Event.onDOMReady(function() {
				var tmppbar = getProgressBar( {startdate: <?=$this->Player_Model->now_town->build_start?>, enddate: <?=$end_date?>, currentdate: <?=time()?>,	bar: "upgradeProgress"} );
				//display percentage in title of progressbar
				tmppbar.subscribe("update", function(){ this.barEl.title=this.progress+"%"; });
				tmppbar.subscribe("finished", function(){ this.barEl.title="100%"; });
				});
			</script>
		<div class="time" id="upgradeCountDown"><?=format_time($ostalos)?></div>
			<script type="text/javascript">
			Event.onDOMReady(function() {
				var tmpCnt = getCountdown({enddate: <?=$end_date?>,currentdate: <?=time()?>,el: "upgradeCountDown"}, 2, " ", "", true, true);
				//load building page 2000ms after finishing
				tmpCnt.subscribe("finished", function() {
					setTimeout(function() { location.href="<?=$this->config->item('base_url')?>game/<?=$this->Data_Model->building_class_by_type($type)?>/<?=$position?>/";},2000); });
				});
			</script>
		<a class="cancelUpgrade" href="<?=$this->config->item('base_url')?>game/demolition/<?=$position?>/" title="Отменить"><span class="textLabel">Отменить</span></a>
	</div>
	<div class="footer"></div>
</div>
 
<?}?>

<div id="backTo" class="dynamic">
	<h3 class="header"><?=$this->Data_Model->building_name_by_type($type)?></h3>
	<div class="content">
		<a href="<?=$this->config->item('base_url')?>game/<?=$this->Data_Model->building_class_by_type($type)?>/<?=$position?>/" title="Назад к Казарма">
		<img src="<?=$this->config->item('style_url')?>skin/buildings/y100/<?=$this->Data_Model->building_class_by_type($type)?>.gif" width="160" height="100">
		<span class="textLabel">&lt;&lt; Назад к <?=$this->Data_Model->building_name_by_type($type)?></span></a>
	</div>
	<div class="footer"></div>
</div>