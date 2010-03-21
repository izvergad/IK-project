<?$position = $param1?>
<div id="mainview" class="phase<?=$this->Town_Model->level?>"> 
    <ul id="locations">
<?
for ($i = 0; $i <= 14; $i++)
{
    $class = $this->Town_Model->buildings[$i]['type'];
    $level = $this->Town_Model->buildings[$i]['level'];
    $sub_class = ($i > 0) & ($i < 3) ? 'shore' : 'land';
    $sub_class = ($i == 14) ? 'wall' : $sub_class;
    $image = ($level == 0 and $this->Town_Model->buildings[$i]['type'] == 0) ? 'flag' : 'buildingimg';
?>

<?if ($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $i){?>
<?
    $level = ($this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']] != false ) ? $this->Town_Model->buildings[$this->Town_Model->build_line[0]['position']]['level'] : 0;
    $cost = $this->Data_Model->building_cost($this->Town_Model->build_line[0]['type'], $level);
    $end_date = $this->Town_Model->build_start + $cost['time'];
    $ostalos = $end_date - time();
?>

        <li id="position<?=$i?>" class="<?=$this->Data_Model->building_class_by_type($this->Town_Model->build_line[0]['type'])?>">
            <div class="constructionSite"></div>
            <a href="<?=$this->config->item('base_url')?>game/<?=$this->Data_Model->building_class_by_type($this->Town_Model->build_line[0]['type'])?>/<?=$i?>/" title="<?=$this->Data_Model->building_name_by_type($this->Town_Model->build_line[0]['type'])?> Уровень <?=$level?>"><span class="textLabel"><?=$this->Data_Model->building_name_by_type($this->Town_Model->build_line[0]['type'])?> Уровень <?=$level?> (В процессе строительства)</span></a>
            <div class="timetofinish"><span class="before"></span><span class="textLabel">Время до завершения: </span><span id="cityCountdown"><?=format_time($ostalos)?></span><span class="after"></span></div>

        <script type="text/javascript">
            var tmpCnt =    getCountdown({
                enddate: <?=$end_date?>,
                currentdate: <?=time()?>,
                el: "cityCountdown"
            });
            tmpCnt.subscribe("finished", function() {
                top.document.title = "Икариам";
                setTimeout(function() {
                    location.href="<?=$this->config->item('base_url')?>game/city/";
                },2000);
            });
        </script>

<?}else{?>
        <li id="position<?=$i?>" class="<?=$this->Data_Model->building_class_by_type($class)?> <?if ($level == 0 and $this->Town_Model->buildings[$i]['type'] == 0){?><?=$sub_class?><?}?>">
<?if ($i == 13 and $this->User_Model->research->res2_13 == 0) {?>
            <div></div>
            <a href="#" title="Прежде чем построить на этом месте, Вам необходимо исследовать государственный аппарат!"><span class="textLabel">Прежде чем построить на этом месте, Вам необходимо исследовать государственный аппарат!</span></a>
<?}else{?>
            <div class="<?=$image?>"></div>
            <a href="<?=$this->config->item('base_url')?>game/<?=$this->Data_Model->building_class_by_type($class)?>/<?=$i?>/" title="<?=$this->Data_Model->building_name_by_type($class)?> Уровень <?=$level?>"><span class="textLabel"><?=$this->Data_Model->building_name_by_type($class)?>  Уровень <?=$level?></span></a>
<?}?>
        </li>
<?}?>

<?
}
?>

<!--
                  <li id="position1" class="port">
                    <div class="constructionSite"></div>
                    <a href="?view=port&amp;id=149657&amp;position=1" title="Торговый порт Уровень 0"><span class="textLabel">Торговый порт Уровень 0 (В процессе строительства)</span></a>
                    <div class="timetofinish"><span class="before"></span><span class="textLabel">Время до завершения: </span><span id="cityCountdown">8мин. 19с.</span><span class="after"></span></div>
<script type="text/javascript">
var tmpCnt =    getCountdown({
        enddate: 1267250479,
        currentdate: 1267249980,
        el: "cityCountdown"
        });
    tmpCnt.subscribe("finished", function() {
        top.document.title = "Ikariam" + " - Мир Eta";
        setTimeout(function() {
        location.href="?view=city&id=149657";
            },2000);
        });
</script>


               </li>
-->

        <li class="beachboys"></li>
    </ul>

<!--[if lt IE 7]>
<style type="text/css">
#city #container #mainview #locations .garnison,
#city #container #mainview #locations .garnisonGate1,
#city #container #mainview #locations .garnisonGate2,
#city #container #mainview #locations .garnisonCenter,
#city #container #mainview #locations .garnisonOutpost
{
    background-image:url(<?=$this->config->item('style_url')?>skin/img/city/garnison.gif);
}
</style>
<![endif]-->
</div>
          