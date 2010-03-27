<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="ru">
        <meta name="Description" content="Икариам - это бесплатная браузерная игра. Задача игроков заключается в управлении народом в древнем мире, основывая города, ведя торговлю и завоевывая другие острова.">
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
        <title>Икариам</title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link href="<?=$this->config->item('style_url')?>skin/ik_common_<?=$this->config->item('style_version')?>.css" rel="stylesheet" type="text/css" media="screen">
        <link href="<?=$this->config->item('style_url')?>skin/ik_<?=$location?>_<?=$this->config->item('style_version')?>.css" rel="stylesheet" type="text/css" media="screen">


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
						currentView : "<?=$location?>"
						},
				currentCity : {
						resources : {
								wood: <?=$this->Town_Model->resources['wood']?>,
								wine: <?=$this->Town_Model->resources['wine']?>,
								marble: <?=$this->Town_Model->resources['marble']?>,
								crystal: <?=$this->Town_Model->resources['crystal']?>,
								sulfur: <?=$this->Town_Model->resources['sulfur']?>						},
						maxCapacity : {
								wood: <?=$this->Town_Model->capacity['wood']?>,
								wine: <?=$this->Town_Model->capacity['wine']?>,
								marble: <?=$this->Town_Model->capacity['marble']?>,
								crystal: <?=$this->Town_Model->capacity['crystal']?>,
								sulfur: <?=$this->Town_Model->capacity['sulfur']?>						}
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

	<body id="<?=$location?>">
            <div id="container">
                <div id="container2">
                    <div id="header">
                        <h1>Икариам</h1>
                        <h2>Древний мир!</h2>
                    </div>
                    <div id="avatarNotes"></div>
                    <?=$bread?>
                    <?=$this->SideBoxes_Model->show($location, $param1, $param2)?>
                    <?=$this->View_Model->show($location, $param1, $param2)?>

<div id="cityNav">
    <form id="changeCityForm" action="<?=$this->config->item('base_url')?>game/<?=$location?>/" method="POST">
        <fieldset style="display: none;">
            <input type="hidden" name="action" value="header">
            <input type="hidden" name="function" value="changeCurrentCity">
            <input type="hidden" name="oldView" value="<?=$location?>">
        </fieldset>

        <h3>Навигация по городам</h3>
        <ul>
            <li>
                <label for="citySelect">Выбранный город:</label>
                <select	id="citySelect"	class="citySelect smallFont" name="cityId" tabindex="1" onchange="this.form.submit()">
<?foreach($this->User_Model->towns as $town){?>
<?$island = $this->User_Model->islands[$town->island]?>
<?$selected = ($this->User_Model->town == $town->id) ? 'selected="selected"' : ''?>
                    <option class="coords" value="<?=$town->id?>" <?=$selected?> title="Торговля: <?=$this->Data_Model->resource_name_by_type($island->trade_resource)?>" ><p>[<?=$island->x?>:<?=$island->y?>]&nbsp;<?=$town->name?></p></option>
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
                <span class="textLabel">Торговые корабли:</span><span>0 (0)</span>
            </a>
        </li>
	<li class="ambrosia" title="<?=number_format($this->User_Model->ambrosy)?> Амброзия">
            <a href="<?=$this->config->item('base_url')?>game/premium/">
                <span class="textLabel">Амброзия:</span><span><?=number_format($this->User_Model->ambrosy)?></span>
            </a>
        </li>
	<li class="gold" title="<?=number_format($this->User_Model->gold)?> Золото">
            <a href="<?=$this->config->item('base_url')?>game/finances/">
                <span class="textLabel">Золото:</span><span id="value_gold"><?=number_format($this->User_Model->gold)?></span>
            </a>
        </li>
    </ul>
</div>

<div id="cityResources"><h3>Ресурсы города</h3>
    <ul class="resources">
        <li class="population" title="Население">
            <span class="textLabel">Население: </span><span id="value_inhabitants" style="display: block; width: 80px;"><?=floor($this->Town_Model->peoples['free'])?> (<?=floor($this->Town_Model->peoples['all'])?>)</span>
	</li>
	<li class="actions" title="Баллы действия">
            <span class="textLabel">Баллы действия: </span><span id="value_maxActionPoints"><?=number_format($this->Town_Model->actions)?></span>
	</li>
	<li class="wood">
            <span class="textLabel">Стройматериалы:</span><span id="value_wood" class="<?if(($this->Town_Model->resources['wood']*1.25) > $this->Town_Model->capacity['wood']){?><?if($this->Town_Model->resources['wood'] >= $this->Town_Model->capacity['wood']){?>storage_full<?}else{?>storage_danger<?}}?>"><?=number_format(floor($this->Town_Model->resources['wood']))?></span>
            <div class="tooltip">
                <span class="textLabel">Вместимость Стройматериалы:</span><?=number_format($this->Town_Model->capacity['wood'])?>
            </div>
	</li>
<?$disabled = ($this->User_Model->research->res2_3 == 0) ? 'disabled' : ''?>
	<li class="wine <?if($this->Town_Model->resources['wine']==0){?><?=$disabled?><?}?>">
            <span class="textLabel">Виноград:</span><span id="value_wine" class="<?if(($this->Town_Model->resources['wine']*1.25) > $this->Town_Model->capacity['wine']){?><?if($this->Town_Model->resources['wine'] >= $this->Town_Model->capacity['wine']){?>storage_full<?}else{?>storage_danger<?}}?>"><?=number_format(floor($this->Town_Model->resources['wine']))?></span>
            <div class="tooltip">
                <span class="textLabel">Вместимость Виноград:</span><?=number_format($this->Town_Model->capacity['wine'])?>
            </div>
	</li>
	<li class="marble <?if($this->Town_Model->resources['marble']==0){?><?=$disabled?><?}?>">
            <span class="textLabel">Мрамор:</span><span id="value_marble" class="<?if(($this->Town_Model->resources['marble']*1.25) > $this->Town_Model->capacity['marble']){?><?if($this->Town_Model->resources['marble'] >= $this->Town_Model->capacity['marble']){?>storage_full<?}else{?>storage_danger<?}}?>"><?=number_format(floor($this->Town_Model->resources['marble']))?></span>
            <div class="tooltip"><span class="textLabel">Вместимость Мрамор: </span><?=number_format($this->Town_Model->capacity['marble'])?>
            </div>
	</li>
	<li class="glass <?if($this->Town_Model->resources['crystal']==0){?><?=$disabled?><?}?>">
            <span class="textLabel">Хрусталь:</span><span id="value_crystal" class="<?if(($this->Town_Model->resources['crystal']*1.25) > $this->Town_Model->capacity['crystal']){?><?if($this->Town_Model->resources['crystal'] >= $this->Town_Model->capacity['crystal']){?>storage_full<?}else{?>storage_danger<?}}?>"><?=number_format(floor($this->Town_Model->resources['crystal']))?></span>
            <div class="tooltip">
                <span class="textLabel">Вместимость Хрусталь: </span><?=number_format($this->Town_Model->capacity['crystal'])?>
            </div>
	</li>
	<li class="sulfur <?if($this->Town_Model->resources['sulfur']==0){?><?=$disabled?><?}?>">
            <span class="textLabel">Сера:</span><span id="value_sulfur" class="<?if(($this->Town_Model->resources['sulfur']*1.25) > $this->Town_Model->capacity['sulfur']){?><?if($this->Town_Model->resources['sulfur'] >= $this->Town_Model->capacity['sulfur']){?>storage_full<?}else{?>storage_danger<?}}?>"><?=number_format(floor($this->Town_Model->resources['sulfur']))?></span>
            <div class="tooltip">
                <span class="textLabel">Вместимость Сера: </span><?=number_format($this->Town_Model->capacity['sulfur'])?>
            </div>
        </li>
    </ul>
</div>


<div id="advisors">

    <h3>Обзоры</h3>
    <ul>
        <li id="advCities">
            <a href="<?=$this->config->item('base_url')?>game/tradeAdvisor/" title="Обзор городов и финансов" class="normal<?if($this->User_Model->new_town_messages > 0){?>active<?}?>">
                <span class="textLabel">Города</span>
            </a>
            <a class="plusteaser" href="<?=$this->config->item('base_url')?>game/premiumDetails/" title="К обзору">
                <span class="textLabel">К обзору</span>
            </a>
        </li>
	<li id="advMilitary">
            <a href="<?=$this->config->item('base_url')?>game/advisors/military/" title="Военный обзор" class="normal">
                <span class="textLabel">Войска</span>
            </a>
            <a class="plusteaser" href="<?=$this->config->item('base_url')?>game/premiumDetails/" title="К обзору">
                <span class="textLabel">К обзору</span>
            </a>
        </li>
	<li id="advResearch">
            <a href="<?=$this->config->item('base_url')?>game/researchAdvisor/" title="Научный обзор" class="normal">
                <span class="textLabel">Исследования</span>
            </a>
            <a class="plusteaser" href="<?=$this->config->item('base_url')?>game/premiumDetails/" title="К обзору">
                <span class="textLabel">К обзору</span>
            </a>
	</li>
	<li id="advDiplomacy">
            <a href="<?=$this->config->item('base_url')?>game/advisors/diplomacy/" title="Обзор сообщений и дипломатии" class="normal">
                <span class="textLabel">Дипломатия</span>
            </a>
            <a class="plusteaser" href="<?=$this->config->item('base_url')?>game/premiumDetails/" title="К обзору">
                <span class="textLabel">К обзору</span>
            </a>
	</li>
    </ul>
</div>

<!-- TODO Обучение -->
<?if ($this->Town_Model->is_capital){?>
<?=$this->Tutorials_Model->show($location)?>
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
                            <span class="textLabel">Икариам ПЛЮС (<?=number_format($this->User_Model->ambrosy)?>)</span>
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
	available: <?=$this->Town_Model->resources['wood']?>,
	limit: [0, <?=$this->Town_Model->capacity['wood']?>],
	production: <?=$this->Town_Model->peoples['workers']/3600?>,
	valueElem: "value_wood"
	});
if(woodCounter) {
	woodCounter.subscribe("update", function() {
		IKARIAM.currentCity.resources.wood = woodCounter.currentRes;
		});
	}

var tradegoodCounter = getResourceCounter({
	startdate: <?=time()?>,
	interval: 2000,
	available: <?=$this->Town_Model->resources[$this->Data_Model->resource_class_by_type($this->Town_Model->island->trade_resource)]?>,
	limit: [0, <?=$this->Town_Model->capacity[$this->Data_Model->resource_class_by_type($this->Town_Model->island->trade_resource)]?>],
	production: <?=$this->Town_Model->peoples['special']/3600?>,
		valueElem: "value_<?=$this->Data_Model->resource_class_by_type($this->Town_Model->island->trade_resource)?>"
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
            title += getTimestring(timeargs, 3, undefined, undefined, undefined, true);
        top.document.title = title;
    })
    cnt.subscribe("finished", function() {
        top.document.title = "Икариам";
    });
    cnt.startTimer();
    return cnt;
}

<?if($this->Town_Model->build_start > 0){
    $level = ($this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']] != false ) ? $this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']]['level'] : 0;
    $cost = $this->Data_Model->building_cost($this->Town_Model->build_line[0]['type'], $level);
    $end_date = $this->Town_Model->build_start + $cost['time'];
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
        setCookie( 'ikariam_notes_message', document.getElementById("message").value, '9999', '/', '', '' );
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
            avatarNotes.setMaxChars(200);
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
        setCookie( 'ikariam_notes_message', document.getElementById("message").value, '9999', '/', '', '' );
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
</script>

        </body>
</html>
