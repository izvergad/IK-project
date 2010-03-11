<div id="information" class="dynamic" style="z-index:1;">        
    <h3 class="header">Город</h3>
    <div class="content">
        <ul class="cityinfo">
            <li class="name"><span class="textLabel">Имя: </span><?=$this->Town_Model->name?></li>
            <li class="citylevel"><span class="textLabel">Размер: </span><?=$this->Town_Model->buildings[0]['level']?></li>
            <div class="centerButton">
                <a href="<?=$this->config->item('base_url')?>game/military/" class="button">Войска в городе</a>
            </div>
        </ul>
    </div>
    <div class="footer"></div>
</div>

<div class="dynamic" id="reportInboxLeft">
    <h3 class="header">Очередь на строительство</h3>
    <div class="content">
        <img width="203" height="85" src="<?=$this->config->item('style_url')?>skin/research/area_economy.jpg">
        <p>Чтобы воспользоваться очередью на строительство Вам нужен Премиум-аккаунт.</p>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>game/premium/" class="button">Икариам ПЛЮС</a>
        </div>
    </div>
    <div class="footer"></div>
</div>
