<div id="tour">
<h3>Тур по игре (1/5) - Ваш город</h3>
<div id="imgcontainer">
    <img src="<?=$this->config->item('base_url')?>design/tour/tour_city.jpg" width="530" height="230" alt="" >
</div>
<div id="tourtext">
    <p>В начале игры Икариам у Вас есть только маленький клочок земли.</p>
    Сможете ли Вы превратить его в процветающую столицу могучей империи? Эти страницы могут Вам помочь.
</div>
<a class="back" href="#" title="Назад">&laquo; Назад</a>
<a class="next" href="#" title="Продолжить">Дальше &raquo;</a>
</div>

<script>
$(document).ready(function(){
    $(".back").click(function(){
        $('#text').load('<?=$this->config->item('base_url')?>main/page/index/');
    });
    $(".next").click(function(){
        $('#text').load('<?=$this->config->item('base_url')?>main/page/tour_2/');
    });
});
</script>