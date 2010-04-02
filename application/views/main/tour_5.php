<div id="tour">
<h3>Тур по игре (5/5) - Обзоры</h3>
<div id="imgcontainer">
    <img src="<?=$this->config->item('base_url')?>design/tour/tour_views.jpg" width="530" height="230" alt="" >
</div>
<div id="tourtext">
    <p>Вы можете произвольно менять обзор игры. Вам доступны карта мира, карта острова и карта города. </p>
    <p>Теперь, когда  Вы проинформированы об основах игры, осталось только зарегистрироваться (абсолютно бесплатно!) и начать игру!</p>
</div>
<a class="back" href="#" title="Назад">&laquo; Назад</a>
<a class="next" href="#" title="Продолжить">Регистрация!</a>
</div>

<script>
$(document).ready(function(){
    $(".back").click(function(){
        $('#text').hide();
        $('#text').load('<?=$this->config->item('base_url')?>main/page/tour_4/');
        $('#text').fadeIn();
    });
    $(".next").click(function(){
        $('#text').hide();
        $('#text').load('<?=$this->config->item('base_url')?>main/page/register/');
        $('#text').fadeIn();
    });
});
</script>