<div id="ambrosia" class="dynamic">
    <h3 class="header">Амброзия</h3>
    <div class="content">
      <div class="ambrosiaCount"><?=$this->Player_Model->user->ambrosy?></div>
      <div>Амброзия</div>
      <div class="centerButton">
          <a href="<?=$this->config->item('base_url')?>game/premiumPayment/" class="button">Получить амброзию</a>
      </div>
    </div>
    <div class="footer"></div>
</div>

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

<div id="backTo" class="dynamic">
  <h3 class="header">Назад</h3>
  <div class="content">
    <a href="<?=$this->config->item('base_url')?>game/city/" title="Назад в город">
      <span class="textLabel">&lt;&lt; Назад в город</span>
    </a>
    </div>
  <div class="footer"></div>
</div> 