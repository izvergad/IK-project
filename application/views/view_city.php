<div id="mainview" class="phase<?=$this->Town_Model->level?>"> 
    <ul id="locations">
<?
for ($i = 0; $i <= 14; $i++)
{
    $class = $this->Town_Model->buildings[$i]['type'];
    $level = $this->Town_Model->buildings[$i]['level'];
    $sub_class = ($i > 0) & ($i < 3) ? 'shore' : 'land';
    $sub_class = ($i == 14) ? 'wall' : $sub_class;
    $image = ($level == 0) ? 'flag' : 'buildingimg';
?>
        <li id="position<?=$i?>" class="<?=$this->Data_Model->building_class_by_type($class)?> <?if ($level == 0){?><?=$sub_class?><?}?>">
<?if ($i == 13) {?>
            <div></div>
            <a href="#" title="Прежде чем построить на этом месте, Вам необходимо исследовать государственный аппарат!"><span class="textLabel">Прежде чем построить на этом месте, Вам необходимо исследовать государственный аппарат!</span></a>
<?}else{?>
            <div class="<?=$image?>"></div>
            <a href="/game/<?=$this->Data_Model->building_class_by_type($class)?>/<?=$i?>/" title="<?=$this->Data_Model->building_name_by_type($class)?> <?if ($level > 0){?>Уровень <?=$level?><?}?>"><span class="textLabel"><?=$this->Data_Model->building_name_by_type(1)?>  <?if ($level > 0){?>Уровень <?=$level?><?}?></span></a>
<?}?>
        </li>
<?
}
?>

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
          