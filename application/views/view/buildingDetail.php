<?$id = $param1?>
<?if($id > 0 and $id <= 26){?>
<div id="mainview">
    <div class="buildingDescription">
        <h1>Описание здания</h1>
    </div>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel"><?=$this->Data_Model->building_name_by_type($id)?></span></h3>
        <div class="content">
            <img alt="<?=$this->Data_Model->building_name_by_type($id)?>" src="<?=$this->config->item('style_url')?>skin/buildings/y100/<?=$this->Data_Model->building_class_by_type($id)?>.gif"/>
            <p><?=$this->Data_Model->building_desc_by_type($id)?></p>
            <!--<p><b>Требования</b> <p>Исследования : нет</p></p>-->
            <div class="centerButton">
                <a class="button" href="javascript:history.back()">Назад</a>
            </div>
<?
    $position = $this->Data_Model->get_position($id, $this->Player_Model->now_town);
    $level_text = 'pos'.$position.'_level';
    $level = $this->Player_Model->now_town->$level_text;
    if ($position == 0 and $id > 1) { $level = 0; }
    $cost = $this->Data_Model->building_cost($id,$level,$this->Player_Model->research);
    $cost_max = $this->Data_Model->building_cost($id,$cost['max_level'],$this->Player_Model->research);
    $wood = ($cost_max['wood'] > 0) ? true : false;
    $wine = ($cost_max['wine'] > 0) ? true : false;
    $marble = ($cost_max['marble'] > 0) ? true : false;
    $crystal = ($cost_max['crystal'] > 0) ? true : false;
    $sulfur = ($cost_max['sulfur'] > 0) ? true : false; 
?>
            <table id="overview">
                <tr>
                    <th>Уровень</th>
<?if ($wood) {?>
                    <th class="costs"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif"></th>
<?}?>
<?if ($wine) {?>
                    <th class="costs"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wine.gif"></th>
<?}?>
<?if ($marble) {?>
                    <th class="costs"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_marble.gif"></th>
<?}?>
<?if ($crystal) {?>
                    <th class="costs"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_crystal.gif"></th>
<?}?>
<?if ($sulfur) {?>
                    <th class="costs"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_sulfur.gif"></th>
<?}?>
                    <th class="costs"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_time.gif" /></th>
<?switch($id){?>
<?case 1:?>
                    <th class="allow">макс. граждан</th>
<?break;?>
<?case 3:?>
                    <th class="allow">Ученые</th>
<?break;?>

<?}?>
                </tr>
<?$start_level = ($level > 5) ? $level - 6 : 0?>
<?$max_level = (($start_level + 15) > $cost['max_level']) ? $cost['max_level'] : $start_level + 15?>
<?for ($i = $start_level; $i <= $max_level; $i++){?>
<?if ($cost['max_level'] >= $i) {?>
<?$cost = $this->Data_Model->building_cost($id,$i, $this->Player_Model->research)?>
                <tr >
                    <td class="level"><?=$i+1?></td>
<?if ($wood) {?>
                    <td class="costs"><?=number_format($cost['wood'])?></td>
<?}?>
<?if ($wine) {?>
                    <td class="costs"><?=number_format($cost['wine'])?></td>
<?}?>
<?if ($marble) {?>
                    <td class="costs"><?=number_format($cost['marble'])?></td>
<?}?>
<?if ($crystal) {?>
                    <td class="costs"><?=number_format($cost['crystal'])?></td>
<?}?>
<?if ($sulfur) {?>
                    <td class="costs"><?=number_format($cost['sulfur'])?></td>
<?}?>
                    <td class="costs"><?=format_time($cost['time'])?></td>
<?switch($id){
    case 1:?>
                    <td class="allow"><?echo number_format($this->Data_Model->peoples_by_level($i))?></th>
<?break;
    case 3:?>
                    <td class="allow"><?echo number_format($this->Data_Model->scientists_by_level($i+1))?></th>
<?break;

}?>
                </tr>
<?}?>
<?}?>
            </table>
            <div class="centerButton">
                <a class="button" href="javascript:history.back()">Назад</a>
            </div>
        </div>
        <div class="footer"></div>
    </div>
</div>
<?}?>