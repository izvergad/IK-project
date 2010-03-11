<div id="breadcrumbs">
    <h3>Вы здесь:</h3>
    <a href="<?=$this->config->item('base_url')?>game/world/" title="Назад к карте мира">
        <img src="<?=$this->config->item('style_url')?>skin/layout/icon-world.gif" alt="Мир">
    </a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="<?=$this->config->item('base_url')?>game/island/" class="island" title="Назад к острову"><?=$this->Town_Model->island->name?>[<?=$this->Town_Model->island->x?>:<?=$this->Town_Model->island->y?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="city"><?=$this->Town_Model->name?></span>
</div>
