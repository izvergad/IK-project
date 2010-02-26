<div id="mainview">			
    <div class="buildingDescription">
        <h1>Участок для постройки</h1>
        <p>Перед Вами находится обширный пустырь. Какое здание Вы хотите здесь построить?</p>
    </div>

    <div class="contentBox01h">
        <h3 class="header">Построить здание</h3>
        <div class="content">
            <ul id="buildings">

                <li class="building academy">
                    <div class="buildinginfo">
                        <h4>Академия</h4>
                        <a href="?view=buildingDetail&buildingId=4"><img src="<?=$this->config->item('style_url')?>skin/buildings/y100/academy.gif" /></a>
                        <p>Академия - это источник мудрости, где древние знания применяются в сочетании с современными технологиями. Мудрейшие головы Вашего города толпятся у входа и ждут, когда наконец перед ними распахнутся двери! Но учтите, что каждый ученый нуждается в своей собственной лаборатории, которая стоит денег. Чем больше академия, тем больше ученых Вы можете использовать одновременно.</p>
                    </div>
                    <hr>
                    <div class="centerButton">
                        <a class="button build" style="padding-left:3px;padding-right:3px;" href="?action=CityScreen&function=build&actionRequest=5ff9471cbc9996503a7afaa2513c5bd2&id=75684&position=9&building=4">
                            <span class="textLabel">Построить</span>
                        </a>
                    </div>
                    <div class="costs">
                        <h5>Стоимость:</h5>
                        <ul class="resources">
                            <li class="wood" title="Стройматериалы">
                                <span class="textLabel">Стройматериалы: </span>64
                            </li>
                            <li class="time" title="Время постройки">
                                <span class="textLabel">Время постройки: </span>8мин. 24с.
                            </li>
                        </ul>
                    </div>
                </li>
			
            </ul>
        </div>
        <div class="footer"></div>
    </div>
</div>
 