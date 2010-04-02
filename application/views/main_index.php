<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta name="language" content="ru">
		<meta name="Description" content="Икариам - это бесплатная браузерная игра. Задача игроков - управлять своим собственным народом в древнем мире, строить города, вести торговлю, завоевывать острова.">
		<title>Икариам - Бесплатная браузерная игра</title>
                <link href="<?=$this->config->item('style_url')?>start.css" rel="stylesheet" type="text/css" media="screen">
                <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/jquery.min.js"></script>
    </head>
    <body>
        <div id="headback">
            <div id="headlogo">
            </div>

            <div id="main">
                <div id="wrapper">
                    <div id="links">
                        <a href="#" id="main_index" title="Ко входу">Вход</a>
                        <a href="#" id="main_register" title="Регистрация!">Регистрация</a>
                        <a href="#" id="main_tour" title="Небольшой тур по миру Икариам">Тур по игре</a>
                        <!--<a href="/forum/" target="_blank" title="На форум">Форум</a>-->
                    </div>
                </div>
                <div id="text">

                </div>
                <br>
            </div>
            <div id="footer"></div>
            <div id="footer2">© 2010 by Nexus.</div>
        </div>
    </body>
</html>

<script>
$(document).ready(function(){
    $('#text').load('<?=$this->config->item('base_url')?>main/page/<?=$page?>/');
    $("#main_index").click(function(){
        $('#text').hide();
        $('#text').load('<?=$this->config->item('base_url')?>main/page/index/');
        $('#text').fadeIn();
    });
    $("#main_register").click(function(){
        $('#text').hide();
        $('#text').load('<?=$this->config->item('base_url')?>main/page/register/');
        $('#text').fadeIn();
    });
    $("#main_tour").click(function(){
        $('#text').hide();
        $('#text').load('<?=$this->config->item('base_url')?>main/page/tour/');
        $('#text').fadeIn();
    });
});
</script>