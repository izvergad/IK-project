<?
    $level_text = 'pos'.$position.'_level';
    $level = $this->Player_Model->now_town->$level_text;
?>
<div class="dynamic">
    <h3 class="header">Грузоподъемность<a class="help" href="<?=$this->config->item('base_url')?>game/shipDescription/23/" title="Помощь"><span class="textLabel">Помощь?</span></a></h3>
    <div class="content">
    	<p>Торговые судна всегда доступны в тех местах, где они требуются.</p>
        <p><strong>Вместимость торгового судна: </strong>500</p>
    </div>
    <div class="footer"></div>
</div>

<div class="dynamic">
    <h3 class="header">Время загрузки</h3>
    <div class="content">
    	<p>Скорость погрузки показывает, как быстро торговые судна могут быть загружены и разгружены в Вашем порту.</p>
        <p><strong>Время загрузки:</strong><br> <?=number_format($this->Data_Model->speed_by_port_level($level))?> Товаров в мин.</p>
    </div>
    <div class="footer"></div>
</div>