<div id="tour">
<h3>Тур по игре (4/5) - Советники</h3>
<div id="imgcontainer">
    <img src="<?=$this->config->item('base_url')?>design/tour/tour_advisors.jpg" width="530" height="230" alt="" >
</div>
<div id="tourtext">
    <p>С Вами всегда будут четыре советника, которые сообщат Вам о поступлении свежих новостей.</p>
    <p>При поступлении новых сообщений советники начинают подсвечиваться. </p>
</div>
<a class="back" href="#" title="Назад">&laquo; Назад</a>
<a class="next" href="#" title="Продолжить">Дальше &raquo;</a>
</div>

<script>
$(document).ready(function(){
    $(".back").click(function(){
        $('#text').load('<?=$this->config->item('base_url')?>main/page/tour_3/');
    });
    $(".next").click(function(){
        $('#text').load('<?=$this->config->item('base_url')?>main/page/tour_5/');
    });
});
</script>