<div id="breadcrumbs">
    <h3>Вы здесь:</h3>
    <a href="<?=$this->config->item('base_url')?>game/world/" title="Назад к карте мира">
        <img src="<?=$this->config->item('style_url')?>skin/layout/icon-world.gif" alt="Мир">
    </a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="<?=$this->config->item('base_url')?>game/island/" class="island" title="Назад к острову"><?=$this->Player_Model->now_island->name?>[<?=$this->Player_Model->now_island->x?>:<?=$this->Player_Model->now_island->y?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="city"><?=$this->Player_Model->now_town->name?></span>
</div>