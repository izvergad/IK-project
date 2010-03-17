<?$type = ($this->Town_Model->buildings[$position]['type'] > 0) ? $this->Town_Model->buildings[$position]['type'] : 1?>
<div id="breadcrumbs">
    <h3>Вы здесь:</h3>
    <a href="<?=$this->config->item('base_url')?>game/world/" title="Назад к карте мира">
        <img src="<?=$this->config->item('style_url')?>skin/layout/icon-world.gif" alt="Мир">
    </a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="<?=$this->config->item('base_url')?>game/island/" title="Назад к острову">
        <img src="<?=$this->config->item('style_url')?>skin/layout/icon-island.gif" alt="<?=$this->Town_Model->island->name?>"> [<?=$this->Town_Model->island->x?>:<?=$this->Town_Model->island->y?>]
    </a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="<?=$this->config->item('base_url')?>game/city/" class="city" title="Назад в город"><?=$this->Town_Model->name?></a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="<?=$this->config->item('base_url')?>game/<?=$this->Data_Model->building_class_by_type($type)?>/" class="building" title="<?=$this->Data_Model->building_name_by_type($type)?>"><?=$this->Data_Model->building_name_by_type($type)?></a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building">Подтверждение</span>
</div>