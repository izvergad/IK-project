<div id="breadcrumbs">
    <h3>Вы здесь:</h3>
    <a href="<?=$this->config->item('base_url')?>game/worldmap_iso/" title="Назад к карте мира">
        <img src="<?=$this->config->item('style_url')?>skin/layout/icon-world.gif" alt="Мир">
    </a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="<?=$this->config->item('base_url')?>game/island/<?=$this->Island_Model->island->id?>" class="island" title="Назад к острову"><?=$this->Island_Model->island->name?>[<?=$this->Island_Model->island->x?>:<?=$this->Island_Model->island->y?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building"><?=$this->Data_Model->island_building_by_resource($this->Island_Model->island->trade_resource)?></span>
</div>