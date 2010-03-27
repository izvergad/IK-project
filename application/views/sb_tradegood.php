<?
    $cost = $this->Data_Model->island_cost($this->Island_Model->island->trade_resource,$this->Island_Model->levels[1]);
    $end_time = $this->Island_Model->island->trade_start + $cost['time'];
    $ostalos = $end_time - time();
    $need_wood = $cost['wood'] - $this->Island_Model->resources[1];
    $need_wood = ($need_wood < 0) ? 0 : $need_wood;
    $upgraded = ($this->Island_Model->island->trade_start > 0) ? 'upgrading' : '';
    $max = ($this->Town_Model->resources['wood'] > $need_wood) ? $need_wood : floor($this->Town_Model->resources['wood']);
?>

<div id="resUpgrade" class="dynamic <?=$upgraded?>">
    <h3 class="header"><?=$this->Data_Model->island_building_by_resource($this->Island_Model->island->trade_resource)?>
        <a class="help" href="<?=$this->config->item('base_url')?>game/informations/6/" title="Помощь">
            <span class="textLabel">Нужна помощь?</span>
        </a>
    </h3>

<?if($this->Island_Model->island->trade_start > 0){?>

    <div class="content">
<?switch($this->Island_Model->island->trade_resource){?>
<?case 1:?>
        <img src="<?=$this->config->item('style_url')?>skin/resources/img_wine.jpg" alt="">
<?break;?>
<?case 2:?>
        <img src="<?=$this->config->item('style_url')?>skin/resources/img_marble.jpg" alt="">
<?break;?>
<?case 3:?>
        <img src="<?=$this->config->item('style_url')?>skin/resources/img_glass.jpg" alt="">
<?break;?>
<?case 4:?>
        <img src="<?=$this->config->item('style_url')?>skin/resources/img_sulfur.jpg" alt="">
<?break;?>
<?}?>
        <div class="isUpgrading">В процессе!</div>
        <div class="buildingLevel"><span class="textLabel">Уровень: </span><?=$this->Island_Model->island->trade_level?></div>
        <div class="nextLevel"><span class="textLabel">след. уровень: </span><?=$this->Island_Model->island->trade_level+1?></div>
        <div class="progressBar"><div class="bar" id="upgradeProgress" title="0%" style="width:0%;"></div></div>

                       <script type="text/javascript">
                            Event.onDOMReady(function() {
                                var tmppbar = getProgressBar({
                                    startdate: <?=$this->Island_Model->island->trade_start?>,
                                    enddate: <?=$end_time?>,
                                    currentdate: <?=time()?>,
                                    bar: "upgradeProgress"
                                    });
                                tmppbar.subscribe("update", function(){
                                    this.barEl.title=this.progress+"%";
                                    });
                                tmppbar.subscribe("finished", function(){
                                    this.barEl.title="100%";
                                    });
                                });
                        </script>
                        <div class="time" id="upgradeCountDown"><?=format_time($ostalos)?></div>
                        <script type="text/javascript">
                            Event.onDOMReady(function() {
                                var tmpCnt = getCountdown({
                                    enddate: <?=$end_time?>,
                                    currentdate: <?=time()?>,
                                    el: "upgradeCountDown"
                                    }, 2, " ", "", true, true);
                                tmpCnt.subscribe("finished", function() {
                                    setTimeout(function() {
                                        location.href="<?=$this->config->item('base_url')?>game/resource/<?=$this->Island_Model->island->id?>/";
                                        },2000);
                                    })
                                });
                            </script>
    </div>
<?}else{?>
    <div class="content">
<?switch($this->Island_Model->island->trade_resource){?>
<?case 1:?>
        <img src="<?=$this->config->item('style_url')?>skin/resources/img_wine.jpg" alt="">
<?break;?>
<?case 2:?>
        <img src="<?=$this->config->item('style_url')?>skin/resources/img_marble.jpg" alt="">
<?break;?>
<?case 3:?>
        <img src="<?=$this->config->item('style_url')?>skin/resources/img_glass.jpg" alt="">
<?break;?>
<?case 4:?>
        <img src="<?=$this->config->item('style_url')?>skin/resources/img_sulfur.jpg" alt="">
<?break;?>
<?}?>
        <div class="buildingLevel">
            <span class="textLabel">Уровень: </span><?=$this->Island_Model->island->trade_level?>
        </div>
        <h4>Необходимо для след. уровня:</h4>
        <ul class="resources">
            <li class="wood"><span class="textLabel">Стройматериалы: </span><?=number_format($need_wood)?></li>
        </ul>
        <h4>В наличии:</h4>
        <div>
            <ul class="resources">
                <li class="wood"><span class="textLabel">Стройматериалы: </span><?=number_format($this->Island_Model->resources[1])?></li>
            </ul>
        </div>

        <form id="donateForm" action="<?=$this->config->item('base_url')?>actions/resources/tradegood/<?=$this->Island_Model->island->id?>/"  method="POST">
            <div id="donate">
                <label for="donateWood">Пожертвовать:</label>
                <input type="hidden" name="id" value="<?=$this->Island_Model->island->id?>">
                <input type="hidden" name="type" value="resource">
                <input type="hidden" name="action" value="IslandScreen">
                <input type="hidden" name="function" value="donate">
                <input id="donateWood" name="donation" type="text" autocomplete="off" class="textfield">
                <a href="#setmax" title="Пожертвовать макс." onClick="Dom.get('donateWood').value=<?=$max?>;">max</a>
                <div class="centerButton">
                    <input type="submit" class="button" value="Улучшить">
                </div>
            </div>
        </form>

    </div>
<?}?>
    <div class="footer"></div>
</div>