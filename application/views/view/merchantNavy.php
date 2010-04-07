<div id="mainview">
    <div class="buildingDescription">
        <h1>Торговый флот</h1>
        <p>Здесь Вы получите краткий обзор всех своих торговых флотов, находящихся в пути.</p>
    </div>

    <div class="contentBox">
        <h3 class="header">Перемещение товаров</h3>
        <div class="content">

            <table cellpadding="0" cellspacing="0">

                <tr>
                    <th class="transports"><img src="<?=$this->config->item('style_url')?>skin/characters/fleet/40x40/ship_transport_r_40x40.gif" width="40" height="40" title="Кол-во транспортных кораблей" alt="Кол-во"></th>
                    <th class="source">Старт</th>
                    <th class="mission">Миссия</th>
                    <th class="target">Цель</th>
                    <th class="ika">Прибытие</th>
                    <th class="return">Возвращение</th>
                    <th class="actions">Действия</th>
                </tr>
<?if(SizeOf($this->Player_Model->missions) > 0)?>
<?foreach($this->Player_Model->missions as $mission){?>
<?
    $cost = $this->Data_Model->army_cost_by_type(23, $this->Player_Model->research);
    $x1 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$mission->from]->island]->x;
    $x2 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$mission->to]->island]->x;
    $y1 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$mission->from]->island]->y;
    $y2 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$mission->to]->island]->y;
    $time = $this->Data_Model->time_by_coords($x1,$x2,$y1,$y2,$cost['speed']);
    $elapsed = time() - $mission->mission_start;
    $ostalos = ($time - $elapsed >= 0) ? $time - $elapsed : 0;
    $time_return = ($mission->return_start-$mission->mission_start)*$mission->percent;
    $return_elapsed = time() - $mission->return_start;
    $return_time = ($time_return - $return_elapsed >= 0) ? $time_return - $return_elapsed : 0;
?>
                <tr>
                    <td class="transports"><?=$mission->ship_transport?></td>
                    <td class="source"><a href="<?=$this->config->item('base_url')?>game/island/<?=$this->Player_Model->towns[$mission->from]->island?>/<?=$this->Player_Model->towns[$mission->from]->id?>/"><?=$this->Player_Model->towns[$mission->from]->name?></a></td>
                    <td class="mission gotoown"><?=$this->Data_Model->mission_name_by_type($mission->mission_type)?> <?if($mission->return_start == 0){?><?if($mission->mission_start > 0){?>(в дороге)<?}else{?>(погрузка)<?}?><?}else{?>(возвращение)<?}?></td>
                    <td class="target"><a href="<?=$this->config->item('base_url')?>game/island/<?=$this->Data_Model->temp_towns_db[$mission->to]->island?>/<?=$this->Data_Model->temp_towns_db[$mission->to]->id?>/"><?=$this->Data_Model->temp_towns_db[$mission->to]->name?>&nbsp;</a></td>
                    <td id="ika<?=$mission->id?>" class="ika"><?if($mission->return_start == 0){?><?if($mission->mission_start > 0){?><?=format_time($ostalos)?><?}else{?>Погрузка<?}?><?}else{?>-<?}?></td>
                    <td id="ret<?=$mission->id?>" class="return"><?if($mission->return_start > 0){?><?=format_time($return_time)?><?}else{?>-<?}?></td>
                    <td class="actions">
<?if($mission->return_start == 0){?>
                        <a title="Отозвать флот!" href="<?=$this->config->item('base_url')?>actions/abortFleet/<?=$mission->id?>/0/merchantNavy/">
                            <img src="<?=$this->config->item('style_url')?>skin/advisors/military/icon-back.gif" title="Отозвать флот!">
                        </a>
<?}else{?>
                        -
<?}?>
                    </td>
                    </tr>
                    <tr>
                        <td class="pulldown" colspan="7">
                            <div class="pulldown">
                                <div class="content">
                                    <table cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>
                                                <div class="payload">

                                                    <span class="textLabel">Груз:</span>
                                                    <img src="<?=$this->config->item('style_url')?>skin/img/blank.gif" width="25" height="20">
<?
    $all_resources = $mission->wood+$mission->wine+$mission->marble+$mission->crystal+$mission->sulfur+$mission->peoples;
    $one_percent = 30/$all_resources;
    $wood_icons = $mission->wood*$one_percent;
    $wine_icons = $mission->wine*$one_percent;
    $marble_icons = $mission->marble*$one_percent;
    $crystal_icons = $mission->crystal*$one_percent;
    $sulfur_icons = $mission->sulfur*$one_percent;
    $peoples_icons = $mission->peoples*$one_percent;
    
?>
<?if($wood_icons > 0){?>
<?for ($i = 0; $i < $wood_icons; $i++){?>
<img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" width="25" height="20" title="<?=number_format($mission->wood)?> Стройматериалы" alt=""  style="margin-left:-17px" >
<?}}?>
<?if($wine_icons > 0){?>
<?for ($i = 0; $i < $wine_icons; $i++){?>
<img src="<?=$this->config->item('style_url')?>skin/resources/icon_wine.gif" width="25" height="20" title="<?=number_format($mission->wine)?> Виноград" alt=""  style="margin-left:-17px" >
<?}}?>
<?if($marble_icons > 0){?>
<?for ($i = 0; $i < $marble_icons; $i++){?>
<img src="<?=$this->config->item('style_url')?>skin/resources/icon_marble.gif" width="25" height="20" title="<?=number_format($mission->marble)?> Мрамор" alt=""  style="margin-left:-17px" >
<?}}?>
<?if($crystal_icons > 0){?>
<?for ($i = 0; $i < $crystal_icons; $i++){?>
<img src="<?=$this->config->item('style_url')?>skin/resources/icon_glass.gif" width="25" height="20" title="<?=number_format($mission->crystal)?> Хрусталь" alt=""  style="margin-left:-17px" >
<?}}?>
<?if($sulfur_icons > 0){?>
<?for ($i = 0; $i < $sulfur_icons; $i++){?>
<img src="<?=$this->config->item('style_url')?>skin/resources/icon_sulfur.gif" width="25" height="20" title="<?=number_format($mission->sulfur)?> Сера" alt=""  style="margin-left:-17px" >
<?}}?>
<?if($peoples_icons > 0){?>
<?for ($i = 0; $i < $peoples_icons; $i++){?>
<img src="<?=$this->config->item('style_url')?>skin/resources/icon_citizen.gif" width="25" height="20" title="<?=number_format($mission->peoples)?> Граждане" alt=""  style="margin-left:-17px" >
<?}}?>

                                                </div>
                                            </td>
                                            <td>
                                                <div class="space">
                                                    <img src="<?=$this->config->item('style_url')?>skin/layout/crate.gif" width="22" height="22" alt="Вместимость груза" title="Вместимость груза">
                                                </div> <?=number_format($all_resources)?> / <?=number_format($mission->ship_transport*$this->config->item('transport_capacity'))?>
                                                </td></tr>
                                    </table>
                                </div>
                                <div class="btn"></div>
                            </div>
                        </td>
                    </tr>
<?if($mission->mission_start > 0 and $mission->return_start == 0){?>
            <script type="text/javascript">
                    getCountdown({
                    enddate: <?=time()+$ostalos?>,
                    currentdate: <?=time()?>,
                    el: "ika<?=$mission->id?>"
		});
            </script>
<?}?>
<?if($mission->return_start > 0){?>
            <script type="text/javascript">
                    getCountdown({
                    enddate: <?=time()+$return_time?>,
                    currentdate: <?=time()?>,
                    el: "ret<?=$mission->id?>"
		});
            </script>
<?}?>
<?}?>
                    </table>
        </div>
        <div class="footer"></div>
    </div>
</div>

<script>
Event.onDOMReady( function() {
    var pulldowns = Dom.getElementsByClassName("pulldown", 'div', "mainview");
    for(i=0; i<pulldowns.length; i++) {
				var children = Dom.getChildren(pulldowns[i]);
				children[0].contentHeight=children[0].offsetHeight;
				children[0].style.height='0px';
				children[0].style.position="relative";
				children[0].style.overflow="hidden";
        children[1].onmouseover=function(e) {
					this.style.background="url(<?=$this->config->item('style_url')?>skin/interface/pulldown_contentbox_hover.gif)";
				};
        children[1].onmouseout=function(e) {
					this.style.background="url(<?=$this->config->item('style_url')?>skin/interface/pulldown_contentbox.gif)";
				};
        children[1].onclick=function(e) {
					var pulldown = Dom.getChildren(this.parentNode)[0];
					if(pulldown.offsetHeight>0) pulldown.style.height="0px";
					else pulldown.style.height=pulldown.contentHeight+'px';
				};
    }
});
</script>