<div id="breadcrumbs">
    <h3>Вы здесь:</h3>
    <a href="/game/world/" title="Назад к карте мира">
        <img src="<?=$this->config->item('style_url')?>skin/layout/icon-world.gif" alt="Мир">
    </a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="/game/island/" title="Назад к острову">
        <img src="<?=$this->config->item('style_url')?>skin/layout/icon-island.gif" alt="<?=$this->Town_Model->island_name?>"> [<?=$this->Town_Model->x?>:<?=$this->Town_Model->y?>]
    </a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="/game/city/" class="city" title="Назад в город">Полис</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="building">Пустырь</span>
</div>