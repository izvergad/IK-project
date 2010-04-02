<div id="backTo" class="dynamic">
    <h3 class="header">Войска в городе</h3>
    <div class="content">
        <a href="<?=$this->config->item('base_url')?>game/city/" title="Назад в город">
        <img src="<?=$this->config->item('style_url')?>skin/img/action_back.gif" width="160" height="100">
        <span class="textLabel">&lt;&lt; Назад в город</span></a>
    </div>
    <div class="footer"></div>
</div>
<?if ($type == 'army'){?>
<div class="dynamic" id="reportInboxLeft">
    <h3 class="header">Распустить войска</h3>
    <div class="content">
        <img src="<?=$this->config->item('style_url')?>skin/layout/militay-dismissed.jpg" />
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>game/armyGarrisonEdit/" class="button">Распустить войска</a>
        </div>
    </div>
    <div class="footer"></div>
</div>
<div class="dynamic" id="">
    <h3 class="header">Казарма</h3>
    <div class="content">
    	<img src="<?=$this->config->item('style_url')?>skin/buildings/y100/barracks.gif" />
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>game/barracks/" class="button">К казарме</a>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?}else{?>
<div class="dynamic" id="reportInboxLeft"> 
    <h3 class="header">Распустить флот</h3> 
    <div class="content"> 
        <img src="<?=$this->config->item('style_url')?>skin/layout/flotte_entlassen.jpg" />
        <div class="centerButton"> 
            <a href="<?=$this->config->item('base_url')?>game/fleetGarrisonEdit/" class="button">Распустить флот</a>
        </div> 
    </div> 
    <div class="footer"></div> 
</div> 
<div class="dynamic" id=""> 
    <h3 class="header">Верфь</h3> 
    <div class="content"> 
        <img src="<?=$this->config->item('style_url')?>skin/buildings/y100/shipyard.gif" alt="Верфь" />
        <div class="centerButton"> 
            <a href="<?=$this->config->item('base_url')?>game/shipyard/" class="button">К верфи</a>
        </div> 
    </div> 
    <div class="footer"></div> 
</div> 
<?}?>