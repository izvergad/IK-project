<?
$cost = $this->Data_Model->island_cost(0, $this->Island_Model->levels[0]-1);
$peoples = floor($this->Town_Model->peoples['free']);
$all = $this->Town_Model->peoples['free'] + $this->Town_Model->peoples['workers'];
$max = ($cost['workers'] >= $all) ? $all : $cost['workers'];
?>

<div id="mainview">
    <div class="buildingDescription">
        <h1>Лесопилка</h1>
        <p>Древесина поступает на лесопилку из соседнего леса. После обработки она превращается в стройматериалы, необходимые для постройки зданий.
Лесопилка улучшается всеми жителями острова. Чем больше лесопилка, тем больше рабочих Вы можете на ней использовать.</p>      
    </div>

    <form id="setWorkers" action="/actions/workers/resource/<?=$this->Island_Model->island->id?>"  method="POST">
        <div id="setWorkersBox" class="contentBox">
            <h3 class="header"><span class="textLabel">Назначить рабочих</span></h3>
            <div class="content">
                <ul>
                    <li class="citizens"><span class="textLabel">Граждане: </span><span class="value" id="valueCitizens"><?=$peoples?></span></li>
                    <li class="workers"><span class="textLabel">Работников: </span><span class="value" id="valueWorkers"><?=floor($this->Town_Model->peoples['workers'])?></span></li>
                    <li class="gain" title="Производство:0" alt="Производство:0">
                        <span class="textLabel">Вместимость: </span>
                        <div id="gainPoints">
                            <div id="resiconcontainer">
                                <img id="resicon" src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" width="25" height="20" />
                            </div>
                        </div>
                        <div class="gainPerHour">
                            <span id="valueResource" >+<?=floor($this->Town_Model->peoples['workers'])?></span> <span class="timeUnit">в час</span>
                        </div>
                    </li>
                    <li class="costs">
                        <span class="textLabel">Доход города: </span>
                        <span id="valueWorkCosts" class="negative"><?=floor($this->Town_Model->peoples['free']*3)?></span>
                        <img src="<?=$this->config->item('style_url')?>skin/resources/icon_gold.gif" title="Золото" alt="Золото">
                        <span class="timeUnit"> в час</span>
                    </li>
                </ul> 
                <div id="overchargeMsg" class="status nooc ocready oced">Перегрузка!</div>
                <div class="slider" id="sliderbg">
                    <div class="actualValue" id="actualValue"></div>
                    <div class="overcharge" id="overcharge"></div>
                    <div id="sliderthumb"></div>
                </div>
                <a class="setMin" href="#reset" onClick="sliders['default'].setActualValue(0); return false;" title="нет рабочих"><span class="textLabel">мин.</span></a>
                <a class="setMax" href="#max" onClick="sliders['default'].setActualValue(<?=$max?>); return false;" title="макс. число рабочих"><span class="textLabel">макс.</span></a>

                <input class="textfield" id="inputWorkers" type="text" name="rw" maxlength="4" autocomplete="off">
                <input class="button" id="inputWorkersSubmit" type="submit" value="Подтверждение">
            </div>
            <div class="footer"></div>
        </div>
    </form>

    <div id="resourceUsers" class="contentBox">
        <h3 class="header"><span class="textLabel">Другие игроки на этом острове</span></h3>
        <div class="content">
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>Игрок
                            <a href="?view=resource&type=resource&id=5135&sortBy=name&order=asc" class="unicode">&uArr;</a>
                            <a href="?view=resource&type=resource&id=5135&sortBy=name&order=desc" class="unicode">&dArr;</a>
                        </th>
                        <th>Город                    </th>
                        <th>Уровень                    </th>
                        <th>Работников                    </th>
                        <th>Пожертвовано
                            <a href="?view=resource&type=resource&id=5135&sortBy=donation&order=asc" class="unicode">&uArr;</a>
                            <a href="?view=resource&type=resource&id=5135&sortBy=donation&order=desc" class="unicode">&dArr;</a>
                        </th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>

<tr class="alt avatar ">
<td class="ownerName">Glimmer</td>
<td class="cityName">Тушино</td>
<td class="cityLevel">Уровень 4</td>
<td class="cityWorkers">158 Работников</td>
<td class="ownerDonation">182 <img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" width="25" height="20" alt="Стройматериалы" /></td>
<td class="actions"><a href="/index.php?view=sendIKMessage&receiverId=39195"><img src="<?=$this->config->item('style_url')?>skin/interface/icon_message_write.gif" alt="Создать сообщение" /></a></td>
</tr>

<tr class="alt own avatar ">
<td class="ownerName">nexus2009</td>
<td class="cityName">Полис</td>
<td class="cityLevel">Уровень 1</td>
<td class="cityWorkers">0 Работников</td>
<td class="ownerDonation">0 <img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" width="25" height="20" alt="Стройматериалы" /></td>
<td class="actions">&nbsp;</td>
</tr>

            
                </tbody>
            </table>
        </div>
        <div class="footer"></div>
    </div>
</div>

<script type="text/javascript">    
    create_slider({
        dir : 'ltr',
        id : "default",
        maxValue : <?=$cost['workers']?>,
        overcharge : 0,
        iniValue : <?=floor($this->Town_Model->peoples['workers'])?>,
        bg : "sliderbg",
        thumb : "sliderthumb",
        topConstraint: -10,
        bottomConstraint: 344,
        bg_value : "actualValue",
        bg_overcharge : "overcharge",
        textfield:"inputWorkers"
    });
    Event.onDOMReady(function() {
	var slider = sliders["default"];
        var res = new resourceStack({
            container : "resiconcontainer",
            resourceicon : "resicon",
            width : 140
        });
        res.setIcons(Math.floor(slider.actualValue/(1+0.05*slider.actualValue)));
        slider.subscribe("valueChange", function() {
            res.setIcons(Math.floor(slider.actualValue/(1+0.05*slider.actualValue)));
        });
        var startSlider = slider.actualValue;
        var valueWorkers = Dom.get("valueWorkers");
        var valueCitizens = Dom.get("valueCitizens");
        var valueResource = Dom.get("valueResource");
        var valueWorkCosts = Dom.get("valueWorkCosts");
        var inputWorkersSubmit = Dom.get("inputWorkersSubmit");
        slider.flagSliderMoved =0;
        slider.subscribe("valueChange", function() {
            var startCitizens = <?=floor($this->Town_Model->peoples['free'])?>;
            var startResourceWorkers = <?=floor($this->Town_Model->peoples['workers'])?>;
            var startIncomePerTimeUnit = <?=floor($this->Town_Model->peoples['free']*3)?>;
            this.flagSliderMoved = 1;
            valueWorkers.innerHTML = locaNumberFormat(slider.actualValue);
            valueCitizens.innerHTML = locaNumberFormat(startCitizens+startResourceWorkers - slider.actualValue);
            var valRes = 1 * 1 * (Math.min(<?=$cost['workers']?>, slider.actualValue) + Math.max(0, 0.25 * (slider.actualValue-196)));
            valueResource.innerHTML = '+' + Math.floor(valRes);
            valueWorkCosts.innerHTML = startIncomePerTimeUnit  - 3*(slider.actualValue-startSlider);
        });
        slider.subscribe("slideEnd", function() {
            if (this.flagSliderMoved) {
                inputWorkersSubmit.className = 'buttonChanged';
            }
        });
    });
</script>