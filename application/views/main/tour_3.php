<div id="tour"><h3>Тур по игре (3/5) - Строительство объектов</h3><div id="imgcontainer">    <img src="<?=$this->config->item('base_url')?>design/tour/tour_construction.jpg" width="530" height="230" alt="" ></div><div id="tourtext">    <p>После добычи достаточного количества ресурсов Вы можете заняться расширением города.</p>    <p>1. Академия позволит Вам проводить новые исследования.<br>        2. В казарме Вы сможете тренировать войска.<br>        3. Строительство торгового порта и кораблей позволит Вам торговать ресурсами с остальными игроками.</p></div><a class="back" href="#" title="Назад">&laquo; Назад</a><a class="next" href="#" title="Продолжить">Дальше &raquo;</a></div><script>$(document).ready(function(){    $(".back").click(function(){        $('#text').hide();        $('#text').load('<?=$this->config->item('base_url')?>main/page/tour_2/');        $('#text').fadeIn();    });    $(".next").click(function(){        $('#text').hide();        $('#text').load('<?=$this->config->item('base_url')?>main/page/tour_4/');        $('#text').fadeIn();    });});</script>