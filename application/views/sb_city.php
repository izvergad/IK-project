<div id="information" class="dynamic" style="z-index:1;">        
    <h3 class="header">Город</h3>
    <div class="content">
        <ul class="cityinfo">
            <li class="name"><span class="textLabel">Имя: </span><?=$this->Town_Model->name?></li>
            <li class="citylevel"><span class="textLabel">Размер: </span><?=$this->Town_Model->buildings[0]['level']?></li>
            <div class="centerButton">
                <a href="<?=$this->config->item('base_url')?>game/military/" class="button">Войска в городе</a>
            </div>
        </ul>
    </div>
    <div class="footer"></div>
</div>

<div class="dynamic" id="unitConstructionList">
    <h3 class="header">Очередь на строительство</h3>
    <div class="content">
<?if($this->User_Model->premium_account > 0){?>
<?if($this->Town_Model->build_text != ''){
    $ostalos_all = 0;
?>
<?
        $level = ($this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']] != false ) ? $this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']]['level'] : 0;
        $cost = $this->Data_Model->building_cost($this->Town_Model->build_line[0]['type'], $level);
        $end_date = $this->Town_Model->build_start + $cost['time'];
        $ostalos = $end_date - time();
        if ($ostalos < 0){ $ostalos = 0; }
        $ostalos_all = $ostalos_all + $ostalos;
        $one_percent = ($cost['time']/100);
        $percent = 100 - floor($ostalos/$one_percent);
?>
    <h4>В процессе создания:</h4>
    <div class="currentUnit <?=$this->Data_Model->building_class_by_type($this->Town_Model->build_line[0]['type'])?>">
        <div class="amount"><span class="textLabel"><?=$this->Data_Model->building_name_by_type($this->Town_Model->build_line[0]['type'])?></span></div>
        <div class="progressbar"><div class="bar" id="buildProgress" title="<?=$percent?>%" style="width:<?=$percent?>%;"></div></div>
        <div class="time" id="buildCountDown"><?=format_time($ostalos_all)?><span class="textLabel"> до завершения</span></div>
    </div>

<script type="text/javascript">
	getCountdown({
		enddate: <?=$end_date?>,
		currentdate: <?=time()?>,
		el: "buildCountDown"
		}, 2, " ", "", true, true);

	var tmppbar = getProgressBar({
		startdate: <?=$this->Town_Model->build_start?>,
		enddate: <?=$end_date?>,
		currentdate: <?=time()?>,
		bar: "buildProgress"
		});
	tmppbar.subscribe("update", function(){
		this.barEl.title=this.progress+"%";
		});
	tmppbar.subscribe("finished", function(){
		this.barEl.title="100%";
		});
</script>

    <h4>В очереди:</h4>
    <ul>
<?for($i = 1; $i < SizeOf($this->Town_Model->build_line); $i++){?>
<?
        $level = ($this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']] != false ) ? $this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']]['level'] : 0;
        $cost = $this->Data_Model->building_cost($this->Town_Model->build_line[0]['type'], $level);
        $end_date = $this->Town_Model->build_start + $cost['time'];
        $ostalos = $end_date - time();
        if ($ostalos < 0){ $ostalos = 0; }
        $ostalos_all = $ostalos_all + $ostalos;
?>
    <li class="<?=$this->Data_Model->building_class_by_type($this->Town_Model->build_line[$i]['type'])?>">
        <div class="amount"><span class="textLabel"> <?=$this->Data_Model->building_name_by_type($this->Town_Model->build_line[$i]['type'])?></span></div>
        <div class="time" id="queueEntry1"><?=format_time($ostalos_all)?><span class="textLabel"> до завершения</span></div>
    </li>
<?}?>
    </ul>
<!--    <div style="text-align:center; padding: 10px 0 10px 0;">
        <a class="button" href="javascript:myConfirm('Вы уверены что хотите отменить строительство? Все вложенные ресурсы будут потеряны.','<?=$this->config->item('base_url')?>actions/abortBuildings/<?=$this->Town_Model->id?>/');">Отменить</a>
    </div>-->
<?}?>
<?}else{?>
        <img width="203" height="85" src="<?=$this->config->item('style_url')?>skin/research/area_economy.jpg">
        <p>Чтобы воспользоваться очередью на строительство Вам нужен Премиум-аккаунт.</p>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>game/premium/" class="button">Икариам ПЛЮС</a>
        </div>
<?}?>
    </div>
    <div class="footer"></div>
</div>
