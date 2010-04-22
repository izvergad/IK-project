<div id="mainview">
<div id="reductionBuilding">
<?include_once('building_description.php')?>
    <div class="contentBox01h">
        <div class="buildingPictureImg"><img src="<?=$this->config->item('style_url')?>skin/img/city/small/building_carpentering.gif"></div>
        <h3 class="header"><span class="textLabel">Экономия стройматериалов - Здания</span></h3>
        <div class="content">
<?
    $base = 100;
    $research = 0;
        // Исследования уменьшают стоимость зданий
        // Шкив
        if ($this->Player_Model->research->res2_2 > 0){$research = $research +2;}
        // Геометрия
        if ($this->Player_Model->research->res2_6 > 0){$research = $research +4;}
        // Водяной уровень
        if ($this->Player_Model->research->res2_11 > 0){$research = $research +8;}
    $research_percent = $base - $research;
    $building_percent = $research_percent - $this->Player_Model->levels[$this->Player_Model->town_id][21];
    $building_percent2 = $base - $this->Player_Model->levels[$this->Player_Model->town_id][21];
?>
            <table cellspacing="0" cellspacing="0" border="0" style="margin:0 auto 0px;">
                <tr>
                    <th class='brownHeader' colspan="3"></th>
                </tr>
                <tr >
                    <td class="col1Style">Исходная стоимость:</td>
                    <td class="col2Style"><span title="Всего"><b>100.00%</b></span></td>
                    <td class="col3Style"><div class="brownBarDiv barBorder" style="width:99%" title="Стоимость"></div></td>
                </tr>
                <tr class="alt">

                    <td class="col1Style"><b>-</b> Исследования (<?=$research?>.00%):</td>
                    <td class="col2Style"><span title="Всего"><b><?=$research_percent?>.00%</b></span></td>
                    <td class="col3Style"><div class="greenBarDiv barBorder" style="width:<?=$base-1?>%" title="Стоимость"><div class="brownBarDiv" style="width:<?=$research_percent?>%" title="Стоимость"></div></div></td>
                </tr>
                <tr >
                    <td class="col1Style"><b>-</b> Плотницкая мастерская (<?=$this->Player_Model->levels[$this->Player_Model->town_id][21]?>.00%):</td>
                    <td class="col2Style"><span title="Всего"><b><?=$building_percent?>.00%</b></span></td>
                    <td class="col3Style"><div class="greenBarDiv barBorder" style="width:<?=$research_percent-1?>%" title="Стоимость"><div class="brownBarDiv" style="width:<?=$building_percent-1?>%" title="Стоимость"></div></div></td>
                </tr>
            </table>
        </div>
        <div class="footer"></div>
    </div>

    <div class="contentBox01h">
        <div class="buildingPictureImg"><img src="<?=$this->config->item('style_url')?>skin/img/city/small/building_carpentering.gif" /></div>
        <h3 class="header"><span class="textLabel">Экономия стройматериалов - Войсковые части</span></h3>
        <div class="content">
            <table cellspacing="0" cellspacing="0" border="0" style="margin:0 auto 0px;">
                <tr>
                    <th class='brownHeader' colspan="3"></th>
                </tr>
                <tr >
                    <td class="col1Style">Исходная стоимость:</td>
                    <td class="col2Style"><span title="Всего"><b>100.00%</b></span></td>
                    <td class="col3Style"><div class="brownBarDiv barBorder" style="width:99%" title="Стоимость"></div></td>
                </tr>
                <tr class="alt">
                    <td class="col1Style"><b>-</b> Плотницкая мастерская (<?=$this->Player_Model->levels[$this->Player_Model->town_id][21]?>.00%):</td>
                    <td class="col2Style"><span title="Всего"><b><?=$building_percent2?>.00%</b></span></td>
                    <td class="col3Style"><div class="greenBarDiv barBorder" style="width:99%" title="Стоимость"><div class="brownBarDiv" style="width:<?=$building_percent2?>%" title="Стоимость"></div></div></td>
                </tr>
            </table>
        </div>
        <div class="footer"></div>
    </div>

    <div class="contentBox01h">
        <div class="buildingPictureImg"><img src="<?=$this->config->item('style_url')?>skin/img/city/small/building_carpentering.gif" /></div>
        <h3 class="header"><span class="textLabel">Экономия стройматериалов - Корабли</span></h3>
        <div class="content">
            <table cellspacing="0" cellspacing="0" border="0" style="margin:0 auto 0px;">
                <tr>
                    <th class='brownHeader' colspan="3"></th>
                </tr>
                <tr >
                    <td class="col1Style">Исходная стоимость:</td>
                    <td class="col2Style"><span title="Всего"><b>100.00%</b></span></td>
                    <td class="col3Style"><div class="brownBarDiv barBorder" style="width:99%" title="Стоимость"></div></td>
                </tr>
                <tr class="alt">
                    <td class="col1Style"><b>-</b> Плотницкая мастерская (<?=$this->Player_Model->levels[$this->Player_Model->town_id][21]?>.00%):</td>
                    <td class="col2Style"><span title="Всего"><b><?=$building_percent2?>.00%</b></span></td>
                    <td class="col3Style"><div class="greenBarDiv barBorder" style="width:99%" title="Стоимость"><div class="brownBarDiv" style="width:<?=$building_percent2?>%" title="Стоимость"></div></div></td>
                </tr>
            </table>
        </div>
        <div class="footer"></div>
    </div>
</div>
</div>
