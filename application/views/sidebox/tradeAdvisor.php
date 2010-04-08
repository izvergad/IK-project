<div class="dynamic" id="viewCityImperium">
    <h3 class="header">Обзор построек</h3>
    <div class="content">
<?if($this->Player_Model->user->premium_account > 0){?>
                <img src="<?=$this->config->item('style_url')?>skin/research/area_city.jpg" width="203" height="85">
        <p>Обзор построек даёт возможность следить за состоянием колоний и таким образом упрощает управление империей.</p>
        <div class="centerButton">
            <a href="<?=$this->config->item('base_url')?>game/premiumTradeAdvisor/" class="button">К обзору</a>
        </div>
<?}else{?>
		<img src="<?=$this->config->item('style_url')?>skin/premium/sideAd_premiumTradeAdvisor.jpg" width="203" height="85">

    	<p>У Вас много колоний? <strong>Строительный Обзор</strong> дает Вам полный контроль над всеми городами!</p>
        <div class="centerButton">
          <a href="<?=$this->config->item('base_url')?>game/premiumDetails/" class="button">Просмотр.</a>
        </div>
<?}?>
    </div>
    <div class="footer"></div>
</div>