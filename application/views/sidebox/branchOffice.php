<div id="trader" class="dynamic">
    <h3 class="header">Премиум-торговец</h3>
    <div class="content">
        <img src="<?=$this->config->item('style_url')?>skin/research/area_economy.jpg" width="203" height="85" />
        <p style="text-align:center;">Прямой обмен ресурсов! Курсы:<br />
        <strong style="font-size:1.2em;">Стройматериалы: 1 к 1!</strong><br />
        <strong style="font-size:1.2em;">Ресурсы: 1 к 1!</strong></p>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>game/premiumTrader/" class="button" title="к торговцу">к торговцу</a>
        </div>
    </div>
    <div class="footer"></div>
</div>

<div class="dynamic">
    <h3 class="header">Вместимость <a class="help" href="<?=$this->config->item('base_url')?>game/buildingDetail/12/" title="Помощь"><span class="textLabel">Нужна помощь?</span></a></h3>
    <div class="content">
        <p><strong>Текущая вместимость:</strong> <?=number_format($this->Data_Model->branchOffice_capacity_by_level($this->Player_Model->levels[$this->Player_Model->town_id][12]))?></p>
    </div>
    <div class="footer"></div>
</div>