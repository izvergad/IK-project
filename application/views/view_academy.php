<div id="mainview">
    <div class="buildingDescription">
        <h1>Академия</h1>
        <p>Академия - это источник мудрости, где древние знания применяются в сочетании с современными технологиями. Мудрейшие головы Вашего города толпятся у входа и ждут, когда наконец перед ними распахнутся двери! Но учтите, что каждый ученый нуждается в своей собственной лаборатории, которая стоит денег.
        Чем больше академия, тем больше ученых Вы можете использовать одновременно.</p>
    </div>
         
    <form id="setScientists" action="/action/scientists/" method="POST">
        <div class="contentBox01h">
            <h3 class="header"><span class="textLabel">Назначить рабочих</span></h3>
            <div class="content">
                <ul>
                    <li class="citizens"><span class="textLabel">Граждане: </span><span class="value" id="valueCitizens">20</span></li>
                    <li class="scientists"><span class="textLabel">Ученые: </span><span class="value" id="valueWorkers">0</span></li>
                    <li class="gain">
                        <span class="textLabel">Научные достижения: </span>
                        <div id="gainPoints">
                            <img id="lightbulb" src="skin/layout/bulb-on.gif" width="14" height="21">
                        </div>
                        <div style="position:absolute; top:22px; left:145px;">
                            <span id="valueResearch" class="positive overcharged">+0</span>
                            <span class="timeUnit">в час</span>
                        </div>
                    </li>
                    <li class="costs"><span class="textLabel">Доход города: </span><span id="valueWorkCosts" class="negative">60</span> <img src="skin/resources/icon_gold.gif" title="Золото" alt="Золото" /><span class="timeUnit"> в час</span></li>
                </ul>
                <div id="overchargeMsg" class="status nooc ocready oced">Перегрузка!</div>
                <div class="slider" id="sliderbg">
                    <div class="actualValue" id="actualValue"></div>
                    <div class="overcharge" id="overcharge"></div>
                    <div id="sliderthumb"></div>
                </div>
                <a class="setMin" href="#reset" onClick="sliders['default'].setActualValue(0); return false;" title="Нет ученых"><span class="textLabel">мин.</span></a>
                <a class="setMax" href="#max" onClick="sliders['default'].setActualValue(8); return false;" title="макс. кол-во ученых"><span class="textLabel">макс.</span></a>
                <input type="hidden" name="cityId" value="83402">
                <input autocomplete="off" id="inputScientists" name="s" class="textfield" type="text" maxlength="4">
                <div class="centerButton">
                    <input type="submit" id="inputWorkersSubmit" class="button" value="Подтверждение">
                </div>
            </div>
            <div class="footer"></div>
        </div>
    </form>

    <div id="goToResearch" class="contentBox01h">
        <h3 class="header">Исследования</h3>
        <div class="centerButton">
            <img alt=" " src="skin/resources/icon_research.gif" class="iconResearch" /> Баллы науки: 0
        </div>
        <div class="centerButton"><a class="button" href="?view=researchAdvisor&oldView=academy">Советник по исследованиям</a></div>
        <div class="footer"></div>
    </div>
</div>

<script type="text/javascript">

	create_slider({
      id : "default",
        dir : 'ltr',
        maxValue : 8,
        overcharge : 0,
        iniValue : 0,
        bg : "sliderbg",
        thumb : "sliderthumb",
        topConstraint: -10,
        bottomConstraint: 344,
        bg_value : "actualValue",
        bg_overcharge : "overcharge",
        textfield:"inputScientists"
    });
Event.onDOMReady(function() {
    var resIconDisplay;
    var slider = sliders["default"];
    resIconDisplay = new resourceStack({
        container : "gainPoints",
        resourceicon : "lightbulb",
        width : 140
        });
    resIconDisplay.setIcons(Math.floor(slider.actualValue*1));
    var startSlider = slider.actualValue;
    slider.subscribe("valueChange", function() {
        resIconDisplay.setIcons(Math.floor(slider.actualValue*1));

        var startCitizens = 20;
        var startScientists = 0;
        var startIncomePerTimeUnit = 60;
        flagSliderMoved = 1;

        //res.setIcons(Math.round(slider.actualValue/(1+0.05*slider.actualValue)));
        Dom.get("valueWorkers").innerHTML = locaNumberFormat(slider.actualValue);
        Dom.get("valueCitizens").innerHTML = locaNumberFormat(startCitizens+startScientists - slider.actualValue);
        var valRes = 1*slider.actualValue;
        Dom.get("valueResearch").innerHTML = '+' + Math.floor(valRes);
        Dom.get("valueWorkCosts").innerHTML = startIncomePerTimeUnit  - 9*(slider.actualValue-startSlider);
    });

    var flagSliderMoved =0;
    slider.subscribe("slideEnd", function() {
        if (flagSliderMoved) {
            Dom.get('inputWorkersSubmit').className = 'buttonChanged';
        }
     });
    });
</script>
