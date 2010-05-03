<?if($this->Player_Model->town_id != $this->Player_Model->capital_id){?>
<div class="dynamic" id="abandon">
    <h3 class="header">Покинуть колонию</h3>
    <div class="content">
        <p>Вы можете покинуть свою колонию. Все ресурсы, граждане и войска будут потеряны.</p>
        <a href="<?=$this->config->item('base_url')?>game/abolishColony/" class="button">Покинуть колонию</a>
    </div>
    <div class="footer"></div>
</div>
<?}?>