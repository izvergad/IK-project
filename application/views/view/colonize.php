<?
    $city_text = 'city'.$position;
    if($this->Island_Model->island->$city_text > 0)
    {
        $this->Player_Model->Game_Error('Стройплощадка уже занята!');
    }
?>
<div id="mainview">
    <div class="buildingDescription">
        <h1>Колонизация</h1>
        <p>Это место идеально подходит для основания нового города! Покатый берег обеспечивает выход к морю, а плодородные зеленые холмы могут накормить много людей.</p>
    </div>
    <div id="moveCity" class="contentBox01h" style="z-index:55">
        <h3 class="header">Переместить город на <?=$this->Island_Model->island->name?></h3>
        <div class="content" id="relatedCities">
            <p>За небольшое количество Амброзии, вы можете переместить свои города со всеми жителями и постройками на пустое место.</p>
            <div style="padding:5px 10px 10px 10px;">
                <form action="<?=$this->config->item('base_url')?>actions/colonize/<?=$id?>/<?=$position?>/" method="post">
                    <div style="height:100px">
                        <img src="<?=$this->config->item('style_url')?>skin/premium/movecity.jpg" style="float:left;">
                        <table style="width:400px;background-color:#FFFBEC;border:1px solid #FBE7C0;margin-top:45px;">
                            <tr>
                                <td  style="width:250px;">
                                    <select id="moveCitySelect" class="citySpecialSelect smallFont" name="cityId" tabindex="1" >
                                        <option>-- Выберите город --</option>
<?foreach($this->Player_Model->towns as $town){?>
<?$island = $this->Player_Model->islands[$town->island]?>
<?$selected = ($this->Player_Model->town_id == $town->id) ? 'selected="selected"' : ''?>
                    <option class="coords" value="<?=$town->id?>" <?=$selected?> title="Торговля: <?=$this->Data_Model->resource_name_by_type($island->trade_resource)?>" ><p>[<?=$island->x?>:<?=$island->y?>]&nbsp;<?=$town->name?></p></option>
<?}?>
                                    </select>
                                </td>
                                <td>200<img height="20" width="24" title="Амброзия" alt="Амброзия" src="<?=$this->config->item('style_url')?>skin/premium/ambrosia_icon.gif"/></td>
                                <td style="padding-bottom:10px;">
<?if($this->Player_Model->user->ambrosy < 200){?>
                                    <a class="notenough" style="color:#999;font-weight:normal;font-size:11px;text-decoration:none" href="<?=$this->config->item('base_url')?>game/premium/">Не хватает 200 ед. амброзии!<br><span class="buyNow" style="text-decoration:underline">Купить!</span></a>
<?}else{?>
            <div class="centerButton">
                <input class="button" name="action" type=submit value="Переместить">
            </div>
<?}?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <div class="footer"></div>
    </div>

<script type="text/javascript">
<!--
Event.onDOMReady( function() {
    replaceSelect(Dom.get("moveCitySelect"));
});
//-->
</script>



    <div id="createColony" class="contentBox01h" style="z-index:50">
        <h3 class="header">Основать колонию на <?=$this->Island_Model->island->name?></h3>
        <div class="content">
            <p>Вы можете <em>основать колонию</em> здесь. Колонии - такие же города, как и Ваша столица, хотя она ими управляет. <em>Уровень дворца столицы</em> определяет количество колоний, которые Вы можете основать. Чтобы основать больше городов, необходимо улучшить дворец!</p>
            <div class="costs">			
                <img src="<?=$this->config->item('style_url')?>skin/img/colony_build.jpg">
                <p>Для основания колонии требуется:</p>
                <ul class="resources">
                    <li class="citizens"><span class="textLabel">Граждане: </span>40</li>
                    <li class="gold"><span class="textLabel">Золото: </span>9,000</li>
                    <li class="wood"><span class="textLabel">Стройматериалы: </span>1,250</li>
                </ul>
            </div>
<?$errors = array()?>
<?if($this->Player_Model->now_town->peoples < 40){ $errors[] = 'Недостаточно граждан! Вам необходимо <strong>'.number_format(40-$this->Player_Model->now_town->peoples).' граждан</strong>!';} ?>
<?if($this->Player_Model->user->gold < 9000){ $errors[] = 'Недостаточно золота! Вам необходимо <strong>'.number_format(9000-$this->Player_Model->user->gold).' золота</strong>!';} ?>
<?if($this->Player_Model->now_town->wood < 1250){ $errors[] = 'Недостаточно стройматериалов! Вам необходимо <strong>'.number_format(1250-$this->Player_Model->now_town->wood).' стройматериалов</strong>!';} ?>
<?if(SizeOf($errors)> 0){?>
            <div class="errors">
                <h4>Пока еще не все требования выполнены для основания колонии: </h4>
                <ul>
<?foreach($errors as $error){?>
                    <li><span><?=$error?></span></li>
<?}?>
                </ul>
            </div>
<?}?>
        </div>
        <div class="footer"></div>
    </div>
</div>