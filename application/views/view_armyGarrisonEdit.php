<?$position = $this->Data_Model->get_position(5, $this->Town_Model->buildings)?>
<?$level = isset($this->Town_Model->buildings[$position]['level']) ? $this->Town_Model->buildings[$position]['level'] : 0?>

<div id="mainview">
    <div class="buildingDescription">
        <h1>Инспектировать гарнизон</h1>
        <p>Здесь Вы можете распустить войска, которые Вам больше не нужны.</p>
    </div>
    <form id="fireForm"  action="<?=$this->config->item('base_url')?>actions/armyEdit/barracks/" method="post">
        <div class="contentBox01h">

            <h3 class="header">Роспуск войск</h3>
            <div class="content">
                <br>
                <ul id="units">
<?for($i = 1; $i <= 14; $i++){?>
<?$class = $this->Data_Model->army_class_by_type($i)?>
<?if($this->User_Model->armys[$this->Town_Model->id]->$class > 0){?>
<?$cost = $this->Data_Model->army_cost_by_type($i, $this->User_Model->research);?>

                    <li class="unit <?=$class?>">
                        <div class="unitinfo">
                            <h4><?=$this->Data_Model->army_name_by_type($i)?></h4>
                            <img src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/<?=$class?>_r_120x100.gif">
                            <div class="unitcount"><span class="textLabel">Доступно: </span><?=$this->User_Model->armys[$this->Town_Model->id]->$class?></div>
                            <p><?=$this->Data_Model->army_desc_by_type($i)?></p>
                        </div>
                        <label for="<?=$class?>"><?=$this->Data_Model->army_name_by_type($i)?> распустить:</label>
                        <div class="sliderinput">
                            <div class="sliderbg" id="sliderbg_<?=$class?>">
                                <div class="actualValue" id="actualValue_<?=$class?>"></div>
                                <div class="sliderthumb" id="sliderthumb_<?=$class?>"></div>
                            </div>

							<script type="text/javascript">
							create_slider({
                                                                dir : 'ltr',
								id : "slider_<?=$class?>",
								maxValue : <?=$this->User_Model->armys[$this->Town_Model->id]->$class?>,
								overcharge : 0,
								iniValue : 0,
								bg : "sliderbg_<?=$class?>",
								thumb : "sliderthumb_<?=$class?>",
								topConstraint: -10,
								bottomConstraint: 326,
								bg_value : "actualValue_<?=$class?>",
								textfield:"textfield_<?=$class?>"
							});
							var slider = sliders["default"];
							</script>

                            <a class="setMin" href="#reset" onClick="sliders['slider_<?=$class?>'].setActualValue(0); return false;" title="Eingabe zurücksetzen"><span class="textLabel">мин.</span></a>
                            <a class="setMax" href="#max" onClick="sliders['slider_<?=$class?>'].setActualValue(<?=$this->User_Model->armys[$this->Town_Model->id]->$class?>); return false;" title="Möglichst viele entlassen"><span class="textLabel">макс.</span></a>
                        </div>
                        <div class="forminput">
                            <input class="textfield" id="textfield_<?=$class?>" type="text" name="<?=$i?>"  value="0" size="4" maxlength="4"> <a class="setMax" href="#max" onClick="sliders['slider_<?=$class?>'].setActualValue(<?=$this->User_Model->armys[$this->Town_Model->id]->$class?>); return false;" title="Рекрутировать максимум"><span class="textLabel">макс.</span></a>
                            <div class="centerButton">
                                <input title="Роспуск войск!" class="button" type="submit" value="распустить!">
                            </div>
                        </div>
                        <div class="costs">
                            <h5>Стоимость:</h5>
                            <ul class="resources">
<?if($cost['gold'] > 0){?>
                                <li class="upkeep" title="Содержание в час"><span class="textLabel">Содержание в час: </span><?=$cost['gold']?></li>
<?}?>
                            </ul>
                        </div>
                    </li>

<?}?>
<?}?>
                <br><br>
                </ul>
            </div>
            <div class="footer"></div>
        </div>
    </form>
</div>