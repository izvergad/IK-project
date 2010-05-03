<div class="dynamic">
    <h3 class="header">Влияние</h3>
    <div class="content">
        <p>Баллы дипломатии: 0</p>
    </div>
    <div class="footer"></div>
</div>
<div class="dynamic" id="viewDiplomacyImperium">
    <h3 class="header">Обзор дипломатии</h3>
    <div class="content">
<?if($this->Player_Model->user->premium_account > 0){?>
                <img src="<?=$this->config->item('style_url')?>skin/research/area_diplomacy.jpg" width="203" height="85" />
    	<p>Обзор дипломатии показывает место нахождения Ваших шпионов и позволяет управлять их миссиями.</p>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>game/premiumDiplomacyAdvisor/" class="button">К обзору</a>
        </div>
<?}else{?>
		<img src="<?=$this->config->item('style_url')?>skin/premium/sideAd_premiumDiplomacyAdvisor.jpg" width="203" height="85">
    	<p>Слова даются нелегко? Договариваться всегда легче, когда больше знаешь о своих оппонентах!</p>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>game/premiumDetails/" class="button">Просмотр.</a>
        </div>
<?}?>
    </div>
    <div class="footer"></div>
</div>
<div class="dynamic" id="islandBoardOverview">
    <h3 class="header">Форум</h3>
    <div class="content">
        <ul>
<?foreach($this->Player_Model->islands as $island){?>
<?foreach($this->Player_Model->towns as $town){if($town->island == $island->id){ $town_name = $town->name; } }?>
        <li <?if($island->id == $this->Player_Model->now_town->island){?>class="current"<?}?>><a href="<?=$this->config->item('base_url')?>/game/islandBoard/<?=$island->id?>/"><?=$island->name?> [<?=$town_name?>]</a></li>
<?}?>
        </ul>
    </div>
    <div class="footer"></div>
</div>