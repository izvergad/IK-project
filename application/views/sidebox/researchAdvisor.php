<div class="dynamic" id="">
    <h3 class="header">Обзор</h3>
    <div class="content">
    	<ul class="researchLeftMenu">
    		<li class="scientists">Ученые: <?=floor($this->Player_Model->scientists)?></li>
        	<li class="points">Баллы науки: <?=floor($this->Player_Model->research->points)?></li>
        	<li class="time">в час: <?=floor($this->Player_Model->plus_research*$this->Player_Model->scientists)?></li>
        </ul>
    </div>
    <div class="footer"></div>
</div>
<div class="dynamic" id="viewResearchImperium">
    <h3 class="header">Обзор исследований</h3>
    <div class="content">
		<img src="<?=$this->config->item('style_url')?>skin/premium/sideAd_premiumResearchAdvisor.jpg" width="203" height="85">
    	<p>Знание - сила. Больше знаний - больше силы. Хотите узнать больше? Нажмите сюда!</p>
        <div class="centerButton">
          <a href="<?=$this->config->item('base_url')?>game/premiumDetails/" class="button">Просмотр.</a>
        </div>
    </div>
    <div class="footer"></div>
</div> 