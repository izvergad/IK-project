<div id="tour"><h3>Тур по игре (2/5) - Ресурсы</h3><div id="imgcontainer">    <img src="<?=$this->config->item('base_url')?>design/tour/tour_resources.jpg" width="530" height="230" alt="" ></div><div id="tourtext">    <p>Существуют пять видов ресурсов:<br>        <img src="<?=$this->config->item('base_url')?>design/tour/icon_wood.gif"> стройматериалы,        <img src="<?=$this->config->item('base_url')?>design/tour/icon_wine.gif"> вино,        <img src="<?=$this->config->item('base_url')?>design/tour/icon_marble.gif"> мрамор,        <img src="<?=$this->config->item('base_url')?>design/tour/icon_glass.gif"> хрусталь и        <img src="<?=$this->config->item('base_url')?>design/tour/icon_sulfur.gif"> сера.    </p>    <p>Во время игры Вам понадобится большое количество строительных материалов. Отправляйте рабочих на выработку древесины и добывайте вместе с другими игроками полезные ископаемые на Вашем острове!</p></div><a class="back" href="#" title="Назад">&laquo; Назад</a><a class="next" href="#" title="Продолжить">Дальше &raquo;</a></div><script>$(document).ready(function(){    $(".back").click(function(){        $('#text').hide();        $('#text').load('<?=$this->config->item('base_url')?>main/page/tour_1/');        $('#text').fadeIn();    });    $(".next").click(function(){        $('#text').hide();        $('#text').load('<?=$this->config->item('base_url')?>main/page/tour_3/');        $('#text').fadeIn();    });});</script>