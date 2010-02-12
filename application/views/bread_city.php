<div id="breadcrumbs">
    <h3>Вы здесь:</h3>
    <a href="/game/world/<?=$this->Town_Model->x?>/<?=$this->Town_Model->y?>/" title="Назад к карте мира">
        <img src="<?=$this->config->item('style_url')?>skin/layout/icon-world.gif" alt="Мир">
    </a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="/game/island/<?=$this->Town_Model->island?>/" class="island" title="Назад к острову"><?=$this->Town_Model->island_name?>[<?=$this->Town_Model->x?>:<?=$this->Town_Model->y?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="city"><?=$this->Town_Model->name?></span>
</div>
