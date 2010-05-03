<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="ru">
        <meta name="Description" content="Икариам - это бесплатная браузерная игра. Задача игроков заключается в управлении народом в древнем мире, основывая города, ведя торговлю и завоевывая другие острова.">
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
        <title>Икариам - Мир <?=ucfirst($this->session->userdata('universe'))?></title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link href="<?=$this->config->item('style_url')?>skin/ik_common_<?=$this->config->item('style_version')?>.css" rel="stylesheet" type="text/css" media="screen">
        <link href="<?=$this->config->item('style_url')?>skin/ik_<?=$page?>_<?=$this->config->item('style_version')?>.css" rel="stylesheet" type="text/css" media="screen">
<?if($this->config->item('easter')){?>
        <link href="<?=$this->config->item('style_url')?>skin/specialsEaster.css" rel="stylesheet" type="text/css" media="screen">
<?}?>

		<script type="text/javascript" src="<?=$this->config->item('script_url')?>js/complete-<?=$this->config->item('script_version')?>.js"></script>
                <script type="text/javascript">
		/* <![CDATA[ */
		var Event = YAHOO.util.Event,
		Dom   = YAHOO.util.Dom,
		lang  = YAHOO.lang;
		var LocalizationStrings = {};
		LocalizationStrings['timeunits'] = {};
		LocalizationStrings['timeunits']['short'] = {};
		LocalizationStrings['timeunits']['short']['day'] = 'Д.';
		LocalizationStrings['timeunits']['short']['hour'] = 'ч.';
		LocalizationStrings['timeunits']['short']['minute'] = 'мин.';
		LocalizationStrings['timeunits']['short']['second'] = 'с.';
		LocalizationStrings['language']                     = 'ru';
		LocalizationStrings['decimalPoint']               = '.';
		LocalizationStrings['thousandSeperator']     = ',';
		LocalizationStrings['resources'] = {};
		LocalizationStrings['resources']['wood'] = 'Стройматериалы';
		LocalizationStrings['resources']['wine'] = 'Виноград';
		LocalizationStrings['resources']['marble'] = 'Мрамор';
		LocalizationStrings['resources']['crystal'] = 'Хрусталь';
		LocalizationStrings['resources']['sulfur'] = 'Сера';
		LocalizationStrings['resources'][0] = LocalizationStrings['resources']['wood'];
		LocalizationStrings['resources'][1] = LocalizationStrings['resources']['wine'];
		LocalizationStrings['resources'][2] = LocalizationStrings['resources']['marble'];
		LocalizationStrings['resources'][3] = LocalizationStrings['resources']['crystal'];
		LocalizationStrings['resources'][4] = LocalizationStrings['resources']['sulfur'];
		LocalizationStrings['warnings'] = {};
		LocalizationStrings['warnings']['premiumTrader_lackingStorage'] = "F?r folgende Rohstoffe fehlt dir Speicherplatz: $res";
		LocalizationStrings['warnings']['premiumTrader_negativeResource'] = "Du hast zuwenig $res f?r diesen Handel";
		LocalizationStrings['warnings']['tolargeText'] = 'Внимание! Ваш текст слишком длинный!';
		IKARIAM = {
				phpSet : {
						serverTime : "<?=time()?>",
						currentView : "<?=$page?>"
						},
				currentCity : {
						resources : {
								wood: <?=$this->Player_Model->towns[$this->Player_Model->town_id]->wood?>,
								wine: <?=$this->Player_Model->towns[$this->Player_Model->town_id]->wine?>,
								marble: <?=$this->Player_Model->towns[$this->Player_Model->town_id]->marble?>,
								crystal: <?=$this->Player_Model->towns[$this->Player_Model->town_id]->crystal?>,
								sulfur: <?=$this->Player_Model->towns[$this->Player_Model->town_id]->sulfur?>						},
						maxCapacity : {
								wood: <?=$this->Player_Model->capacity[$this->Player_Model->town_id]?>,
								wine: <?=$this->Player_Model->capacity[$this->Player_Model->town_id]?>,
								marble: <?=$this->Player_Model->capacity[$this->Player_Model->town_id]?>,
								crystal: <?=$this->Player_Model->capacity[$this->Player_Model->town_id]?>,
								sulfur: <?=$this->Player_Model->capacity[$this->Player_Model->town_id]?>						}
				},
				view : {
						get : function() {
								return IKARIAM.phpSet.currentView;
								},
						is : function(viewName) {
								return (IKARIAM.phpSet.currentView == viewName)? true : false;
								}
						}
				};
				IKARIAM.time = {
						serverTimeDiff : IKARIAM.phpSet.serverTime*1000-(new Date()).getTime()
				};
		selectGroup = {
			groups:new Array(), //[groupname]=item
			getGroup:function(group) {
				if(typeof(this.groups[group]) == "undefined") {
					this.groups[group] = new Object();
					this.groups[group].activeItem = "undefined";
					this.groups[group].onActivate = function(obj) {};
					this.groups[group].onDeactivate = function(obj) {};
					}
				return this.groups[group];
			},
			activate:function(obj, group) {
				g = this.getGroup(group);
				if(typeof(g.activeItem) != "undefined") {
					g.onDeactivate(g.activeItem);
					}
				g.activeItem=obj;
				g.onActivate(obj);
			}
		};
		selectGroup.getGroup('cities').onActivate = function(obj) {
			YAHOO.util.Dom.addClass(obj.parentNode, "selected");
		}
		selectGroup.getGroup('cities').onDeactivate = function(obj) {
			YAHOO.util.Dom.removeClass(obj.parentNode, "selected");
		}
		function showInContainer(source, target, exchangeClass) {
			if(typeof source == "string") { source = Dom.get(source); }
			if(typeof target == "string") {target = Dom.get(target); }
			if(typeof exchangeClass != "string") { alert("Error: IKARIAM.showInContainer -> Forgot to add an exchangeClass?"); }
			for(i=0; i<target.childNodes.length; i++) {
				if(typeof(target.childNodes[i].className) != "undefined" && target.childNodes[i].className==exchangeClass) {
					target.removeChild(target.childNodes[i]);
				}
			}
			for(i=0; i<source.childNodes.length; i++) {
				if(typeof(source.childNodes[i].className) != "undefined" && source.childNodes[i].className==exchangeClass) {
					clone = source.childNodes[i].cloneNode(true);
					target.insertBefore(clone, target.firstChild.nextSibling);
				}
			}
		}
		selectedCity = -1;
		function selectCity(cityNum, cityId, viewAble) {
		    if(selectedCity == cityNum) {
		        if(viewAble) document.location.href="<?=$this->config->item('base_url')?>game/city/"+cityId;
		        else document.location.href="#";
		    } else {
		        selectedCity = cityNum;
		    }
			showInContainer("cityLocation"+cityNum,"information", "cityinfo");
			showInContainer("cityLocation"+cityNum,"actions", "cityactions");
			var container = document.getElementById("cities");
			var citySelectedClass = "selected";
		}
		function selectBarbarianVillage() {
		  showInContainer("barbarianVilliage","information", "cityinfo");
          showInContainer("barbarianVilliage","actions", "cityactions");
          selectedCity = 0;
		}
		(function(){
			var  m = document.uniqueID /*IE*/
			&& document.compatMode  /*>=IE6*/
			&& !window.XMLHttpRequest /*<=IE6*/
			&& document.execCommand ;
			try{
				if(!!m){
					m("BackgroundImageCache", false, true) /* = IE6 only */
				}
			}catch(oh){};
		})();
		/* ]]> */
		function myConfirm(message, target) {
		    bestaetigt = window.confirm (message);
		    if (bestaetigt == true)
              window.location.href = target;
		}
		</script>
	</head>

	<body id="<?=$page?>">
            <div id="container">
                <div id="container2">
<?$banner_query = $this->db->query("SELECT * FROM `".$this->session->userdata('universe')."_banners` ORDER BY RAND() LIMIT 1")?>
<?if($banner_query->num_rows > 0){?>
<?$banner = $banner_query->row()?>
<style type="text/css">
#banner_skyscraper {
	width:120px;
	height:600px;
	position:absolute;
	left:505px;
	z-index:25;
}
#banner_container {
	top:20px;
	position:absolute;
	width:120px;
	left:50%;
	z-index:25;
}
</style>
                    <div id="banner_container">
                        <div id="banner_skyscraper">
<?if($banner->frame){?>
                            <iframe id="a<?=$banner->id?>" name="a<?=$banner->id?>" src="<?=$banner->frame?>" framespacing="0" frameborder="no" scrolling="no" width="120" height="600" allowtransparency="true">
                            </iframe>
<?}else{?>
                                <a href="<?=$banner->link?>" target="_blank"><img src="<?=$banner->image?>" border="0" alt=""></a>
<?}?>
                        </div>
                    </div>
<?}?>
                    <div id="header">
                        <h1>Икариам</h1>
                        <h2>Древний мир!</h2>
                    </div>
                    <div id="avatarNotes"></div>
                    <?=$this->View_Model->show_bread($page, $param1, $param2, $param3)?>
                    <?=$this->View_Model->show_sidebox($page, $param1, $param2, $param3)?>
                    <?=$this->View_Model->show_view($page, $param1, $param2, $param3)?>

<div id="cityNav">
    <form id="changeCityForm" action="<?=$this->config->item('base_url')?>game/<?=$page?>/" method="POST">
        <fieldset style="display: none;">
            <input type="hidden" name="action" value="header">
            <input type="hidden" name="function" value="changeCurrentCity">
            <input type="hidden" name="oldView" value="<?=$page?>">
        </fieldset>

        <h3>Навигация по городам</h3>
        <ul>
            <li>
                <label for="citySelect">Выбранный город:</label>
                <select	id="citySelect"	class="citySelect smallFont" name="cityId" tabindex="1" onchange="this.form.submit()">
<?foreach($this->Player_Model->towns as $town){?>
<?$island = $this->Player_Model->islands[$town->island]?>
<?$selected = ($this->Player_Model->town_id == $town->id) ? 'selected="selected"' : ''?>
<?switch($this->Player_Model->user->options_select){?>
<?case 0:?>
                    <option class="" value="<?=$town->id?>" <?=$selected?> title="" ><p><?=$town->name?></p></option>
<?break;?>
<?case 1:?>
                    <option class="coords" value="<?=$town->id?>" <?=$selected?> title="Торговля: <?=$this->Data_Model->resource_name_by_type($island->trade_resource)?>" ><p>[<?=$island->x?>:<?=$island->y?>]&nbsp;<?=$town->name?></p></option>
<?break;?>
<?case 2:?>
                    <option class="tradegood<?=$island->trade_resource?>" value="<?=$town->id?>" <?=$selected?> title="[<?=$island->x?>:<?=$island->y?>]" ><p><?=$town->name?></p></option>
<?break;?>
<?}?>
<?}?>
                </select>
            </li>

            <li class="viewWorldmap">
                <a href="<?=$this->config->item('base_url')?>game/worldmap_iso/" tabindex="4" title="Центрировать выбранный город на карте мира">
                    <span class="textLabel">Мир</span>
                </a>
            </li>
            <li class="viewIsland">
                <a href="<?=$this->config->item('base_url')?>game/island/" tabindex="5" title="Перейти на островную карту выбранного города">
                    <span class="textLabel">Остров</span>
                </a>
            </li>
            <li class="viewCity">
                <a href="<?=$this->config->item('base_url')?>game/city/" tabindex="6" title="Инспектировать выбранный город">
                    <span class="textLabel">Город</span>
                </a>
            </li>
        </ul>
    </form>
</div>

<div id="globalResources">
    <h3>Ресурсы империи</h3>
    <ul>
        <li class="transporters" title="Сухогрузов доступно (всего)">
            <a href="<?=$this->config->item('base_url')?>game/merchantNavy/">
                <span class="textLabel">Торговые корабли:</span><span><?=$this->Player_Model->user->transports?> (<?=$this->Player_Model->all_transports?>)</span>
            </a>
        </li>
	<li class="ambrosia" title="<?=number_format($this->Player_Model->user->ambrosy)?> Амброзия">
            <a href="<?=$this->config->item('base_url')?>game/premium/">
                <span class="textLabel">Амброзия:</span><span><?=number_format($this->Player_Model->user->ambrosy)?></span>
            </a>
        </li>
	<li class="gold" title="<?=number_format($this->Player_Model->user->gold)?> Золото">
            <a href="<?=$this->config->item('base_url')?>game/finances/">
                <span class="textLabel">Золото:</span><span id="value_gold"><?=number_format($this->Player_Model->user->gold)?></span>
            </a>
        </li>
    </ul>
</div>

<?$all_peoples = $this->Player_Model->peoples[$this->Player_Model->town_id]?>

<div id="cityResources"><h3>Ресурсы города</h3>
    <ul class="resources">
        <li class="population" title="Население">
            <span class="textLabel">Население: </span><span id="value_inhabitants" style="display: block; width: 80px;"><?=floor($this->Player_Model->now_town->peoples)?> (<?=floor($all_peoples)?>)</span>
	</li>
	<li class="actions" title="Баллы действия">
            <span class="textLabel">Баллы действия: </span><span id="value_maxActionPoints"><?=number_format($this->Player_Model->now_town->actions)?></span>
	</li>
	<li class="wood">
            <span class="textLabel">Стройматериалы: </span><span id="value_wood" class="<?if(($this->Player_Model->now_town->wood*1.25) > $this->Player_Model->capacity[$this->Player_Model->town_id]){?><?if($this->Player_Model->now_town->wood >= $this->Player_Model->capacity[$this->Player_Model->town_id]){?>storage_full<?}else{?>storage_danger<?}}?>"><?=number_format(floor($this->Player_Model->now_town->wood))?></span>
            <div class="tooltip">
                <span class="textLabel">Вместимость Стройматериалы: </span><?=number_format($this->Player_Model->capacity[$this->Player_Model->town_id])?>
                <?if($this->Player_Model->now_town->branch_trade_wood_type == 1 and $this->Player_Model->now_town->branch_trade_wood_count > 0){?>
                <br><span class="textLabel">Рынок: </span><?=number_format($this->Player_Model->now_town->branch_trade_wood_count)?>
                <?}?>
            </div>
	</li>
<?$disabled = ($this->Player_Model->research->res2_3 == 0) ? 'disabled' : ''?>
	<li class="wine <?if($this->Player_Model->now_town->wine==0){?><?=$disabled?><?}?>">
            <span class="textLabel">Виноград: </span><span id="value_wine" class="<?if(($this->Player_Model->now_town->wine*1.25) > $this->Player_Model->capacity[$this->Player_Model->town_id]){?><?if($this->Player_Model->now_town->wine >= $this->Player_Model->capacity[$this->Player_Model->town_id]){?>storage_full<?}else{?>storage_danger<?}}?>"><?=number_format(floor($this->Player_Model->now_town->wine))?></span>
            <div class="tooltip">
                <span class="textLabel">Вместимость Виноград: </span><?=number_format($this->Player_Model->capacity[$this->Player_Model->town_id])?>
                <?if($this->Player_Model->now_town->branch_trade_wine_type == 1 and $this->Player_Model->now_town->branch_trade_wine_count > 0){?>
                <br><span class="textLabel">Рынок: </span><?=number_format($this->Player_Model->now_town->branch_trade_wine_count)?>
                <?}?>
            </div>
	</li>
	<li class="marble <?if($this->Player_Model->now_town->marble==0){?><?=$disabled?><?}?>">
            <span class="textLabel">Мрамор: </span><span id="value_marble" class="<?if(($this->Player_Model->now_town->marble*1.25) > $this->Player_Model->capacity[$this->Player_Model->town_id]){?><?if($this->Player_Model->now_town->marble >= $this->Player_Model->capacity[$this->Player_Model->town_id]){?>storage_full<?}else{?>storage_danger<?}}?>"><?=number_format(floor($this->Player_Model->now_town->marble))?></span>
            <div class="tooltip">
                <span class="textLabel">Вместимость Мрамор: </span><?=number_format($this->Player_Model->capacity[$this->Player_Model->town_id])?>
                <?if($this->Player_Model->now_town->branch_trade_marble_type == 1 and $this->Player_Model->now_town->branch_trade_marble_count > 0){?>
                <br><span class="textLabel">Рынок: </span><?=number_format($this->Player_Model->now_town->branch_trade_marble_count)?>
                <?}?>
            </div>
	</li>
        <li class="glass <?if($this->Player_Model->now_town->crystal==0){?><?=$disabled?><?}?>">
            <span class="textLabel">Хрусталь: </span><span id="value_crystal" class="<?if(($this->Player_Model->now_town->crystal*1.25) > $this->Player_Model->capacity[$this->Player_Model->town_id]){?><?if($this->Player_Model->now_town->crystal >= $this->Player_Model->capacity[$this->Player_Model->town_id]){?>storage_full<?}else{?>storage_danger<?}}?>"><?=number_format(floor($this->Player_Model->now_town->crystal))?></span>
            <div class="tooltip">
                <span class="textLabel">Вместимость Хрусталь: </span><?=number_format($this->Player_Model->capacity[$this->Player_Model->town_id])?>
                <?if($this->Player_Model->now_town->branch_trade_crystal_type == 1 and $this->Player_Model->now_town->branch_trade_crystal_count > 0){?>
                <br><span class="textLabel">Рынок: </span><?=number_format($this->Player_Model->now_town->branch_trade_crystal_count)?>
                <?}?>
            </div>
	</li>
        <li class="sulfur <?if($this->Player_Model->now_town->sulfur==0){?><?=$disabled?><?}?>">
            <span class="textLabel">Сера: </span><span id="value_sulfur" class="<?if(($this->Player_Model->now_town->sulfur*1.25) > $this->Player_Model->capacity[$this->Player_Model->town_id]){?><?if($this->Player_Model->now_town->sulfur >= $this->Player_Model->capacity[$this->Player_Model->town_id]){?>storage_full<?}else{?>storage_danger<?}}?>"><?=number_format(floor($this->Player_Model->now_town->sulfur))?></span>
            <div class="tooltip">
                <span class="textLabel">Вместимость Сера: </span><?=number_format($this->Player_Model->capacity[$this->Player_Model->town_id])?>
                <?if($this->Player_Model->now_town->branch_trade_sulfur_type == 1 and $this->Player_Model->now_town->branch_trade_sulfur_count > 0){?>
                <br><span class="textLabel">Рынок: </span><?=number_format($this->Player_Model->now_town->branch_trade_sulfur_count)?>
                <?}?>
            </div>
	</li>
    </ul>
</div>

<div id="advisors">

    <h3>Обзоры</h3>
    <ul>
        <li id="advCities">
            <a href="<?=$this->config->item('base_url')?>game/tradeAdvisor/" title="Обзор городов и финансов" class="<?if($this->Player_Model->user->premium_account > 0){?>premium<?}else{?>normal<?}?><?if($this->Player_Model->new_towns_messages > 0){?>active<?}?>">
                <span class="textLabel">Города</span>
            </a>
<?if($this->Player_Model->user->premium_account > 0){?>
            <a class="pluslink" href="<?=$this->config->item('base_url')?>game/premiumTradeAdvisor/" title="К обзору">
<?}else{?>
            <a class="plusteaser" href="<?=$this->config->item('base_url')?>game/premiumDetails/" title="К обзору">
<?}?>
                <span class="textLabel">К обзору</span>
            </a>
        </li>
	<li id="advMilitary">
            <a href="<?=$this->config->item('base_url')?>game/militaryAdvisorMilitaryMovements/" title="Военный обзор" class="<?if($this->Player_Model->user->premium_account > 0){?>premium<?}else{?>normal<?}?>">
                <span class="textLabel">Войска</span>
            </a>
<?if($this->Player_Model->user->premium_account > 0){?>
            <a class="pluslink" href="<?=$this->config->item('base_url')?>game/premiumMilitaryAdvisor/" title="К обзору">
<?}else{?>
            <a class="plusteaser" href="<?=$this->config->item('base_url')?>game/premiumDetails/" title="К обзору">
<?}?>
                <span class="textLabel">К обзору</span>
            </a>
        </li>
	<li id="advResearch">
            <a href="<?=$this->config->item('base_url')?>game/researchAdvisor/" title="Научный обзор" class="<?if($this->Player_Model->user->premium_account > 0){?>premium<?}else{?>normal<?}?><?if($this->Player_Model->research_advisor){?>active<?}?>">
                <span class="textLabel">Исследования</span>
            </a>
<?if($this->Player_Model->user->premium_account > 0){?>
            <a class="pluslink" href="<?=$this->config->item('base_url')?>game/premiumResearchAdvisor/" title="К обзору">
<?}else{?>
            <a class="plusteaser" href="<?=$this->config->item('base_url')?>game/premiumDetails/" title="К обзору">
<?}?>
                <span class="textLabel">К обзору</span>
            </a>
	</li>
	<li id="advDiplomacy">
            <a href="<?=$this->config->item('base_url')?>game/diplomacyAdvisor/" title="Обзор сообщений и дипломатии" class="<?if($this->Player_Model->user->premium_account > 0){?>premium<?}else{?>normal<?}?><?if($this->Player_Model->new_user_messages > 0){?>active<?}?>">
                <span class="textLabel">Дипломатия</span>
            </a>
<?if($this->Player_Model->user->premium_account > 0){?>
            <a class="pluslink" href="<?=$this->config->item('base_url')?>game/premiumDiplomacyAdvisor/" title="К обзору">
<?}else{?>
            <a class="plusteaser" href="<?=$this->config->item('base_url')?>game/premiumDetails/" title="К обзору">
<?}?>
                <span class="textLabel">К обзору</span>
            </a>
	</li>
    </ul>
</div>

<?if ($this->Player_Model->capital_id == $this->Player_Model->town_id){?>
    <?=$this->View_Model->show_tutorial($page, $param1)?>
<?}?>

<div id="footer">
    <span class="copyright">&copy; 2010 by Nexus. Страница сгенерирована за {elapsed_time} сек.</span>
</div>

<div id="conExtraDiv1"><span></span></div>
<div id="conExtraDiv2"><span></span></div>
<div id="conExtraDiv3"><span></span></div>
<div id="conExtraDiv4"><span></span></div>
<div id="conExtraDiv5"><span></span></div>
<div id="conExtraDiv6"><span></span></div>

                </div>
            </div>


            <div id="GF_toolbar">
                <h3>Другие опции</h3>
                <ul>
                    <li class="help">
                        <a href="<?=$this->config->item('base_url')?>game/informations/" title="Помощь">
                            <span class="textLabel">Помощь</span>
                        </a>
                    </li>
                    <li class="premium">
                        <a href="<?=$this->config->item('base_url')?>game/premium/" title="Икариам ПЛЮС">
                            <span class="textLabel">Икариам ПЛЮС (<?=number_format($this->Player_Model->user->ambrosy)?>)</span>
                        </a>
                    </li>
                    <li class="highscore">
                        <a href="<?=$this->config->item('base_url')?>game/highscore/" title="Топ-лист игры">
                            <span class="textLabel">Топ-лист</span>
                        </a>
                    </li>
                    <li class="options">
                        <a href="<?=$this->config->item('base_url')?>game/options/" title="Настройки">
                            <span class="textLabel">Настройки</span>
                        </a>
                    </li>
                    <li class="notes">
                        <a href="javascript:switchNoteDisplay()" title="Заметки">
                            <span class="textLabel">Заметки</span>
                        </a>
                    </li>
                    <li class="forum">
                        <a href="/forum/" title="Официальный форум" target="_blank">
                            <span class="textLabel">Форум</span>
                        </a>
                    </li>
                    <li class="logout">
                        <a href="<?=$this->config->item('base_url')?>game/logout/" title="Выйти из игры">
                            <span class="textLabel">Выход</span>
                        </a>
                    </li>
                    <li class="version">
                        <a href="<?=$this->config->item('base_url')?>game/version/" title="Версия игры">
                            <span class="textLabel">v.<?=$this->config->item('game_version')?></span>
                        </a>
                    </li>
                    <li class="serverTime">
                        <a>
                            <span class="textLabel" id="servertime">Обновление времени..</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div id="extraDiv1"><span></span></div>
            <div id="extraDiv2"><span></span></div>
            <div id="extraDiv3"><span></span></div>
            <div id="extraDiv4"><span></span></div>
            <div id="extraDiv5"><span></span></div>
            <div id="extraDiv6"><span></span></div>

<script type="text/javascript">
function makeButton(ele) {
    var Event = YAHOO.util.Event;
    var Dom = YAHOO.util.Dom;
    Event.addListener(ele, "mousedown", function() {
        YAHOO.util.Dom.addClass(ele, "down");
    });
    Event.addListener(ele, "mouseup", function() {
        YAHOO.util.Dom.removeClass(ele, "down");
    });
    Event.addListener(ele, "mouseout", function() {
        YAHOO.util.Dom.removeClass(ele, "down");
    });
}
function ToolTips() {
    var tooltips = Dom.getElementsByClassName ( "tooltip" , "div" , document , function() {
        Dom.setStyle(this, "display", "none");
    })
    for(i=0;i<tooltips.length;i++) {
        Event.addListener ( tooltips[i].parentNode , "mouseover" , function() {
            Dom.getElementsByClassName ( "tooltip" , "div" , this , function() {
                Dom.setStyle(this, "display", "block");
            });
        });
        Event.addListener ( tooltips[i].parentNode , "mouseout" , function() {
            Dom.getElementsByClassName ( "tooltip" , "div" , this , function() {
                Dom.setStyle(this, "display", "none");
            });
        });
    }
}
Event.onDOMReady( function() {
    var links = document.getElementsByTagName("a");
    for(i=0; i<links.length; i++) {
        makeButton(links[i]);
    }
    ToolTips();
    replaceSelect(Dom.get("citySelect"));
});
var woodCounter = getResourceCounter({
	startdate: <?=time()?>,
	interval: 2000,
	available: <?=$this->Player_Model->now_town->wood?>,
	limit: [0, <?=$this->Player_Model->capacity[$this->Player_Model->town_id]?>],
	production: <?=$this->Player_Model->now_town->workers/3600?>,
	valueElem: "value_wood"
	});
if(woodCounter) {
	woodCounter.subscribe("update", function() {
		IKARIAM.currentCity.resources.wood = woodCounter.currentRes;
		});
	}
<?$res_type = $this->Data_Model->resource_class_by_type($this->Player_Model->now_island->trade_resource)?>
var tradegoodCounter = getResourceCounter({
	startdate: <?=time()?>,
	interval: 2000,
 	available: <?=$this->Player_Model->now_town->$res_type?>,
	limit: [0, <?=$this->Player_Model->capacity[$this->Player_Model->town_id]?>],
	production: <?=$this->Player_Model->now_town->tradegood/3600?>,
		valueElem: "value_<?=$res_type?>"
	});
if(tradegoodCounter) {
	tradegoodCounter.subscribe("update", function() {
		IKARIAM.currentCity.resources.marble = tradegoodCounter.currentRes;
		});
	}

var localTime = new Date();
var startServerTime = localTime.getTime() - (3600000) - localTime.getTimezoneOffset()*60*1000; // GMT+1+Sommerzeit - offset
var obj_ServerTime = 0;
Event.onDOMReady(function() {
    var ev_updateServerTime = setInterval("updateServerTime()", 500);
    obj_ServerTime = document.getElementById('servertime');
});
function updateServerTime() {
    var currTime = new Date();
    currTime.setTime(currTime.getTime()) ;
    str = getFormattedDate(currTime.getTime(), 'd.m.Y G:i:s');
    obj_ServerTime.innerHTML = str;
}
function jsTitleTag(nextETA) {
    this.nextETA = nextETA;
    var thisObj = this;
    var cnt = new Timer(nextETA, <?=time()?>, 1);
    cnt.subscribe("update", function() {
        var timeargs = this.enddate - Math.floor(this.currenttime/1000) *1000;
        var title = "Икариам - ";
        if (timeargs != "")
            title += getTimestring(timeargs, 3, undefined, undefined, undefined, true) + " - ";
        title += "Мир <?=ucfirst($this->session->userdata('universe'))?>";
        top.document.title = title;
    })
    cnt.subscribe("finished", function() {
        top.document.title = "Икариам" + " - Мир <?=ucfirst($this->session->userdata('universe'))?>";
    });
    cnt.startTimer();
    return cnt;
}

<?if($this->Player_Model->now_town->build_start > 0){
    $level_text = 'pos'.$this->Player_Model->build_line[$this->Player_Model->town_id][0]['position'].'_level';
    $type_text = 'pos'.$this->Player_Model->build_line[$this->Player_Model->town_id][0]['position'].'_type';
    $level = $this->Player_Model->now_town->$level_text;
    $type = $this->Player_Model->now_town->$type_text;
    $cost = $this->Data_Model->building_cost($type, $level, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->town_id]);
    $end_date = $this->Player_Model->now_town->build_start + $cost['time'];
?>
titleTag = new jsTitleTag(<?=$end_date?>)
<?}?>

var avatarNotes = null;
function switchNoteDisplay() {
    document.cookie = 'notes=0; expires=Thu, 01-Jan-70 00:00:01 GMT;';
    var noteLayer = Dom.get("avatarNotes");
    if (noteLayer.style.display == "block") {
        avatarNotes.save();
        noteLayer.style.display = "none";
    } else {
        if (noteLayer.innerHTML == "") { // nur AjaxRequest starten, wenn Notizen noch nicht geladen sind
            ajaxRequest('<?=$this->config->item('base_url')?>game/avatarNotes/', updateNoteLayer);

            ///setCookie('message', Dom.get("message").text);
            document.cookie = 'notes=1;';
        }
        noteLayer.style.display = "block";
   }
    if (avatarNotes instanceof Notes) {
        setCookie( 'ikariam_notes_x', Dom.get("resizablepanel_c").style.left, '9999', '/', '', '' );
        setCookie( 'ikariam_notes_y', Dom.get("resizablepanel_c").style.top, '9999', '/', '', '' );
        setCookie( 'ikariam_notes_width', Dom.get("resizablepanel").style.width, '9999', '/', '', '' );
        setCookie( 'ikariam_notes_height', Dom.get("resizablepanel").style.height, '9999', '/', '', '' );
        avatarNotes.save();
    }
}
if (getCookie('notes') == 1) {
    switchNoteDisplay();
}
function updateNoteLayer(responseText) {
    var noteLayer = Dom.get("avatarNotes");
    noteLayer.innerHTML = responseText;
            var panel = new YAHOO.widget.Panel("resizablepanel", {
                draggable: true,
                width: getCookie("ikariam_notes_width", "470px"),
                height: getCookie("ikariam_notes_height", "320px"),
                autofillheight: "body", // default value, specified here to highlight its use in the example
                constraintoviewport:true,
                context: ["tl", "bl"]
            });
            panel.render();
            var resize = new YAHOO.util.Resize("resizablepanel", {
                handles: ["br"],
                autoRatio: false,
                minWidth: 220,
                minHeight: 110,
                status: false
            });
            resize.on("startResize", function(args) {
                if (this.cfg.getProperty("constraintoviewport")) {
                    var D = YAHOO.util.Dom;
                    var clientRegion = D.getClientRegion();
                    var elRegion = D.getRegion(this.element);
                    resize.set("maxWidth", clientRegion.right - elRegion.left - YAHOO.widget.Overlay.VIEWPORT_OFFSET);
                    resize.set("maxHeight", clientRegion.bottom - elRegion.top - YAHOO.widget.Overlay.VIEWPORT_OFFSET);
                } else {
                    resize.set("maxWidth", null);
                    resize.set("maxHeight", null);
                }
            }, panel, true);
            resize.on("resize", function(args) {
                var panelHeight = args.height;
                this.cfg.setProperty("height", panelHeight + "px");
                Dom.get("message").style.height = (panelHeight-75) + "px";
            }, panel, true);
            avatarNotes = new Notes();
            avatarNotes.setMaxChars(<?if($this->Player_Model->user->premium_account > 0){?><?=$this->config->item('notes_premium')?><?}else{?><?=$this->config->item('notes_default')?><?}?>);
            avatarNotes.init(Dom.get("message"), Dom.get("chars"));
            Dom.get("resizablepanel_c").style.top = getCookie("ikariam_notes_y", "80px");
            Dom.get("resizablepanel_c").style.left = getCookie("ikariam_notes_x", "375px");
            Dom.get("message").style.height = (parseInt(getCookie("ikariam_notes_height", "320px")) - 75 ) + "px";
}
window.onunload = function() {
    if (avatarNotes instanceof Notes) {
        setCookie( 'ikariam_notes_x', Dom.get("resizablepanel_c").style.left, '9999', '/', '', '' );
        setCookie( 'ikariam_notes_y', Dom.get("resizablepanel_c").style.top, '9999', '/', '', '' );
        setCookie( 'ikariam_notes_width', Dom.get("resizablepanel").style.width, '9999', '/', '', '' );
        setCookie( 'ikariam_notes_height', Dom.get("resizablepanel").style.height, '9999', '/', '', '' );
        avatarNotes.save();
    }
}
function setCookie(name, value, expires, path, domain, secure)
{
	var today = new Date();
	today.setTime( today.getTime() );

    if ( expires ) {
        expires = expires * 1000 * 60 * 60 * 24;
    }
    var expires_date = new Date( today.getTime() + (expires) );
    document.cookie = name + "=" + value + ((expires) ? ";expires=" + expires_date.toGMTString() : "" ) + ((path) ? ";path=" + path : "" ) + ((domain) ? ";domain=" + domain : "" ) + ((secure) ? ";secure" : "" );
}
function getCookie ( check_name, def_val ) {
    var a_all_cookies = document.cookie.split( ';' );
    var a_temp_cookie = '';
    var cookie_name = '';
    var cookie_value = '';
    var b_cookie_found = false;
    for (i=0; i<a_all_cookies.length; i++) {
        a_temp_cookie = a_all_cookies[i].split( '=' );
        cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');
        if ( cookie_name == check_name ) {
            b_cookie_found = true;
            if ( a_temp_cookie.length > 1 ) {
                cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
            }
            return cookie_value;
            break;
        }
        a_temp_cookie = null;
        cookie_name = '';
    }
    if (!b_cookie_found ) {
        return def_val;
    }
}
<?if(!$_POST){?>
//document.getElementsByTagName("DIV")[0].style.display = 'none';
<?}?>
</script>
        </body>
</html>
