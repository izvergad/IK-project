<?$position=$param1?>
<div id="mainview">
    <div class="buildingDescription">
        <h1>Войска в городе</h1>
        <p>Инспектировать войска, размещенные в городе</p>
    </div>

    <div class="militaryAdvisorTabs">
        <table cellpadding="0" cellspacing="0" id="tabz">
            <tr>
                <td<?if ($position == 'army'){?> class="selected"<?}?>><a title="Войсковые части" href="<?=$this->config->item('base_url')?>game/cityMilitary/army/"><em>Войсковые части</em></a>
                </td>
                <td<?if ($position != 'army'){?> class="selected"<?}?>><a title="Корабли" href="<?=$this->config->item('base_url')?>game/cityMilitary/fleet/"><em>Корабли</em></a>
                </td>
            </tr>
        </table>
    </div>

    <div class="yui-navset yui-navset-top" id="demo">
        <div class="yui-content">
<?if ($position == 'army'){?>
            <div id="tab1" style="display: block;">
                <div class="contentBox01h">
                    <h3 class="header"><span class="textLabel">Гарнизон</span></h3>
                    <div class="content">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <th title="Гоплит"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_phalanx_faceright.gif" alt="Гоплит" title="Гоплит"></th>
                                <th title="Паровой гигант"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_steamgiant_faceright.gif" alt="Паровой гигант" title="Паровой гигант"></th>
                                <th title="Копейщик"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_spearman_faceright.gif" alt="Копейщик" title="Копейщик"></th>
                                <th title="Мечник"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_swordsman_faceright.gif" alt="Мечник" title="Мечник"></th>
                                <th title="Пращник"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_slinger_faceright.gif" alt="Пращник" title="Пращник"></th>
                                <th title="Лучник"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_archer_faceright.gif" alt="Лучник" title="Лучник"></th>
                                <th title="Стрелок"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_marksman_faceright.gif" alt="Стрелок" title="Стрелок"></th>
                            </tr>
                            <tr class="count">
<?for($i = 1; $i <= 7; $i++){?>
<?
    if (($i == 1 and $this->Player_Model->research->res4_3 > 0) or // 4
        ($i == 2 and $this->Player_Model->research->res4_12 > 0) or // 12
        ($i == 3) or // 1
        ($i == 4 and $this->Player_Model->research->res4_3 > 0) or // 6
        ($i == 5) or // 2
        ($i == 6 and $this->Player_Model->research->res4_6 > 0) or // 7
        ($i == 7 and $this->Player_Model->research->res4_11 > 0)){ // 9
?>
<?$class = $this->Data_Model->army_class_by_type($i)?>
    <td><?=$this->Player_Model->armys[$this->Player_Model->town_id]->$class?></td>
<?}else{?>
    <td>-</td>
<?}?>
<?}?>
                            </tr>
                        </table>
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <th title="Таран"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_ram_faceright.gif" alt="Таран" title="Таран"></th>
                                <th title="Катапульта"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_catapult_faceright.gif" alt="Катапульта" title="Катапульта"></th>
                                <th title="Мортира"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_mortar_faceright.gif" alt="Мортира" title="Мортира"></th>
                                <th title="Гирокоптер"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_gyrocopter_faceright.gif" alt="Гирокоптер" title="Гирокоптер"></th>
                                <th title="Бомбардировщик"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_bombardier_faceright.gif" alt="Бомбардировщик" title="Бомбардировщик"></th>
                                <th title="Повар"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_cook_faceright.gif" alt="Повар" title="Повар"></th>
                                <th title="Доктор"><img src="<?=$this->config->item('style_url')?>skin/characters/military/x60_y60/y60_medic_faceright.gif" alt="Доктор" title="Доктор"></th>
                            </tr>
                            <tr class="count">
<?for($i = 8; $i <= 14; $i++){?>
<?
    if (($i == 8 and $this->Player_Model->research->res4_4 > 0) or // 3
        ($i == 9 and $this->Player_Model->research->res4_7 > 0) or // 8
        ($i == 10 and $this->Player_Model->research->res4_13 > 0) or // 14
        ($i == 11 and $this->Player_Model->research->res3_12 > 0) or // 10
        ($i == 12 and $this->Player_Model->research->res3_15 > 0) or // 11
        ($i == 13 and $this->Player_Model->research->res2_9 > 0) or // 5
        ($i == 14 and $this->Player_Model->research->res3_8 > 0)){ // 9
?>
<?$class = $this->Data_Model->army_class_by_type($i)?>
    <td><?=$this->Player_Model->armys[$this->Player_Model->town_id]->$class?></td>
<?}else{?>
    <td>-</td>
<?}?>
<?}?>
                            </tr>
                        </table>
                    </div>
                    <div class="footer"></div>
                </div>
<?}else{?>
            <div id="tab2" style="display: block;">
                <div class="contentBox01h">
                    <h3 class="header"><span class="textLabel">Корабли</span></h3>
                    <div class="content">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <th title="Корабль с тараном"><img src="<?=$this->config->item('style_url')?>skin/characters/fleet/60x60/ship_ram_faceright.gif" alt="Корабль с тараном"></th>
                                <th title="Огнеметный корабль"><img src="<?=$this->config->item('style_url')?>skin/characters/fleet/60x60/ship_flamethrower_faceright.gif" alt="Огнеметный корабль"></th>
                                <th title="Пароход с тараном"><img src="<?=$this->config->item('style_url')?>skin/characters/fleet/60x60/ship_steamboat_faceright.gif" alt="Пароход с тараном"></th>
                                <th title="Корабль с баллистой"><img src="<?=$this->config->item('style_url')?>skin/characters/fleet/60x60/ship_ballista_faceright.gif" alt="Корабль с баллистой" /></th>
                            </tr>
                            <tr class="count">
<?for($i = 16; $i <= 19; $i++){?>
<?
    if (($i == 16) or
        ($i == 17 and $this->Player_Model->research->res1_8 > 0) or
        ($i == 18 and $this->Player_Model->research->res1_12 > 0) or
        ($i == 19 and $this->Player_Model->research->res1_2 > 0)){
?>
<?$class = $this->Data_Model->army_class_by_type($i)?>
    <td><?=$this->Player_Model->armys[$this->Player_Model->town_id]->$class?></td>
<?}else{?>
    <td>-</td>
<?}?>
<?}?>
                            </tr>
                        </table>
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <th title="Корабль с катапультой"><img src="<?=$this->config->item('style_url')?>skin/characters/fleet/60x60/ship_catapult_faceright.gif" alt="Корабль с катапультой"></th>
                                <th title="Корабль с мортирой"><img src="<?=$this->config->item('style_url')?>skin/characters/fleet/60x60/ship_mortar_faceright.gif" alt="Корабль с мортирой"></th>
                                <th title="Подводная лодка"><img src="<?=$this->config->item('style_url')?>skin/characters/fleet/60x60/ship_submarine_faceright.gif" alt="Подводная лодка"></th>
                            </tr>
                            <tr class="count">
<?for($i = 20; $i <= 22; $i++){?>
<?
    if (($i == 20 and $this->Player_Model->research->res1_9 > 0) or
        ($i == 21 and $this->Player_Model->research->res1_13 > 0) or
        ($i == 22 and $this->Player_Model->research->res3_14 > 0)){
?>
<?$class = $this->Data_Model->army_class_by_type($i)?>
    <td><?=$this->Player_Model->armys[$this->Player_Model->town_id]->$class?></td>
<?}else{?>
    <td>-</td>
<?}?>
<?}?>
                            </tr>
                        </table>
                    </div>
                    <div class="footer"></div>
                </div> 
<?}?>
                <div class="contentBox01h">
                    <h3 class="header"><span class="textLabel">Защитник</span></h3>
                    <div class="content">
                        <p style="text-align: center;">Нет войск союзников в этом городе!</p>
                    </div>
                    <div class="footer"></div>
                </div>

                <div class="contentBox01h">
                    <h3 class="header"><span class="textLabel">Оккупационные войска</span></h3>
                    <div class="content">
                        <p style="text-align: center;">В этом городе нет вражеских войск!</p>
                    </div>
                    <div class="footer"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    var tabView = new YAHOO.widget.TabView('demo');
    </script>
</div>