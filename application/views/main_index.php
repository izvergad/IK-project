<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="<?=$this->lang->line('content')?>">
		<meta name="Description" content="<?=$this->lang->line('head_description')?>">
		<title><?=$this->lang->line('head_title')?></title>
                <script type="text/javascript" src="<?=$this->config->item('script_url')?>js/jquery.min.js"></script>
<?if($this->config->item('language')=='russian'){?>
                <link href="<?=$this->config->item('base_url')?>design/start-ru.css" rel="stylesheet" type="text/css" media="screen">
<?}else{?>
                <link href="<?=$this->config->item('base_url')?>design/start.css" rel="stylesheet" type="text/css" media="screen">
<?}?>
    </head>
    <body>
        <div id="headback">
            <div id="headlogo">
            </div>

            <div id="main">
                <div id="wrapper">
                    <div id="links">
                        <a href="#" id="main_index" title="<?=$this->lang->line('link_login_title')?>"><?=$this->lang->line('link_login_text')?></a>
                        <a href="#" id="main_register" title="<?=$this->lang->line('link_register_title')?>"><?=$this->lang->line('link_register_text')?></a>
                        <a href="#" id="main_tour" title="<?=$this->lang->line('link_tour_title')?>"><?=$this->lang->line('link_tour_text')?></a>
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
                $('#text').load('<?=$this->config->item('base_url')?>main/page/index/');
            });
            $("#main_register").click(function(){
                $('#text').load('<?=$this->config->item('base_url')?>main/page/register/');
            });
            $("#main_tour").click(function(){
                $('#text').load('<?=$this->config->item('base_url')?>main/page/tour/');
            });
        });
        </script>

