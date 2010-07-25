<div id="information" class="dynamic"></div>
<div id="mainview">
    <div class="buildingDescription">
        <h1>Ошибка!</h1>
    </div>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Сообщение об ошибке</span></h3>
        <div class="content">
            <!--<ul class="error">
            </ul>-->
            <!--<p><br><center><?if($param1){?><?=$param1?><?}elseif($this->session->flashdata('game_error') != ''){?><?=$this->session->flashdata('game_error')?><?}else{?>Страница не найдена!<?}?></center></p>-->
            <p><br><center><?if($param1 != ''){?><?=$param1?><?}else{?>Страница не найдена!<?}?></center></p>
        </div>
        <div class="footer"></div>
    </div>
    <br><br>
</div> 