<div id="mainview">
    <h1 style="text-align:center">Ратуша</h1>

<?if ($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $position){?>
<?
    $level = ($this->Town_Model->buildings[$position] != false ) ? $this->Town_Model->buildings[$position]['level'] : 0;
    $cost = $this->Data_Model->building_cost($this->Town_Model->build_line[0]['type'], $level);
    $end_date = $this->Town_Model->build_start + $cost['time'];
    $ostalos = $end_date - time();
    $one_percent = ($cost['time']/100);
    $percent = 100 - floor($ostalos/$one_percent);
?>

    <div id="upgradeInProgress">
        <div class="isUpgrading">В процессе улучшения!</div>
        <div class="buildingLevel"><span class="textLabel">Уровень </span><?=$this->Town_Model->buildings[$position]['level']?></div>
        <div class="nextLevel"><span class="textLabel">след. уровень </span><?=$this->Town_Model->buildings[$position]['level']+1?></div>
        <div class="progressBar">
            <div class="bar" id="upgradeProgress" title="<?=$percent?>%" style="width:<?=$percent?>%;"></div>
            <a class="cancelUpgrade" href="/actions/demolition/<?=$position?>/" title="Отменить"><span class="textLabel">Отменить</span></a>
        </div>

                                <script type="text/javascript">
				Event.onDOMReady(function() {
					var tmppbar = getProgressBar({
						startdate: <?=$this->Town_Model->build_start?>,
						enddate: <?=$end_date?>,
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
						enddate: <?=$end_date?>,
						currentdate: <?=time()?>,
						el: "upgradeCountDown"
						}, 2, " ", "", true, true);
					tmpCnt.subscribe("finished", function() {
						setTimeout(function() {
							location.href="/game/townHall/<?=$position?>/";
							},2000);
						});
					});
				</script>

    </div>
<?}?>

<? $city_type = ($this->User_Model->capital == $this->Town_Model->id) ? 'Столица' : 'Колония'?>
    
    <div id="CityOverview" class="contentBox">
        <h3 class="header"><?=$city_type?> "<?=$this->Town_Model->name?>"
            <a href="/game/renameCity/" title="Переименовать город">Переименовать</a>
        </h3>

        <div class="content">
            <img class="citizen" src="<?=$this->config->item('style_url')?>skin/characters/y100_citizen_faceright.gif" width="42" height="100" title="" alt="">
            <ul class="stats">
                <li class="space">
                    <span class="textLabel">Жилая площадь: </span>
                    <span class="value occupied"><?=number_format($this->Town_Model->peoples['all'])?></span>/
                    <span class="value total"><?=number_format($this->Town_Model->peoples['max'])?></span>
                </li>
                <li class="growth growth_positive">
                    <span class="textLabel">Рост: </span>
                    <span class="value"><?=number_format($this->Town_Model->good/50, 2, '.', '')?> в час</span>
                </li>
                <li class="actions"><span class="textLabel">Баллы действия: </span>3/3</li>
   <?
    $saldo = $this->Town_Model->peoples['free']*3
   ?>
                <li class="incomegold incomegold_positive">
                    <span class="textLabel">Сальдо золота: </span>
                    <span class="value"><?=number_format($saldo)?></span>
                </li>

                <li class="garrisonLimit"><span class="textLabel">Лимит гарнизона: </span><span class="value occupied"><?=number_format($this->Town_Model->garrison_limit)?></span></li>
                <li class="corruption">
                    <span class="textLabel">Упадок: </span>
                    <span class="value positive">
                        <span title="Упадок: ситуация в данный момент">0%</span>
                    </span>
                </li>
                <li class="happiness happiness_happy">
                    <span class="textLabel">Уровень довольства жизнью: </span>счастье
                </li>
            </ul>
            
<?
// Строим полосу жителей по процентам
    $all_px = 680;   // всего пикселей
    $min_px = 60;    // минимальный размер
    $ostalos_px = $all_px - (60*5); // осталось
    $one_px = $ostalos_px/100;
    $all_plus = $this->Town_Model->peoples['all'];
    $free_px = floor((($this->Town_Model->peoples['free']/$all_plus)*100)*$one_px);
    $workers_px = floor((($this->Town_Model->peoples['workers']/$all_plus)*100)*$one_px+60);
    $special_px = floor((($this->Town_Model->peoples['special']/$all_plus)*100)*$one_px+60);
    $research_px = floor((($this->Town_Model->peoples['research']/$all_plus)*100)*$one_px+60);
    $templer_px = floor((($this->Town_Model->peoples['templer']/$all_plus)*100)*$one_px+60);

    $research_percent = ($this->Town_Model->plus['research']/$all_plus)*100;
    $capital_percent = ($this->Town_Model->plus['capital']/$all_plus)*100;
?>

            <div id="PopulationGraph">			
                <h4>Население и производство:</h4>	
                <div class="citizens" style="left:20px;width:<?=$free_px?>px">
                    <span class="type">
                        <span class="count"><?=floor($this->Town_Model->peoples['free'])?></span>
                        <img src="<?=$this->config->item('style_url')?>skin/characters/40h/citizen_r.gif" title="Граждане" alt="Граждане">
                    </span> 
                    <span class="production">
                        <span class="textLabel">Производство </span>
                        <img src="<?=$this->config->item('style_url')?>skin/resources/icon_gold.gif" alt="Золото"> +<?=floor($this->Town_Model->peoples['free'])*3?>
                    </span>
                </div>
				
                <div class="woodworkers" style="left:<?=$free_px+20?>px;width:<?=$workers_px?>px">
                    <span class="type">
                        <span class="count"><?=$this->Town_Model->peoples['workers']?></span>
                        <img src="<?=$this->config->item('style_url')?>skin/characters/40h/woodworker_r.gif" title="Работников" alt="Работников">
                    </span> 
                    <span class="production">
                        <span class="textLabel">Производство </span>
                        <img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" alt="Стройматериалы"> +0
                    </span>
                </div>
								
                <div class="specialworkers" style="left:<?=$free_px+$workers_px+20?>px;width:<?=$special_px?>px">
                    <span class="type">
                        <span class="count"><?=$this->Town_Model->peoples['special']?></span>
                        <img src="<?=$this->config->item('style_url')?>skin/characters/40h/luxuryworker_r.gif" title="Работников" alt="Работников">
                    </span>       
                    <span class="production">
                        <span class="textLabel">Производство </span>
                        <img src="<?=$this->config->item('style_url')?>skin/resources/icon_glass.gif">+0
                    </span> 
                </div>
								
                <div class="scientists" style="left:<?=$free_px+$workers_px+$special_px+20?>px;width:<?=$research_px?>px">
                    <span class="type">
                        <span class="count"><?=$this->Town_Model->peoples['research']?></span>
                        <img src="<?=$this->config->item('style_url')?>skin/characters/40h/scientist_r.gif" title="Ученые" alt="Ученые">
                    </span> 
                    <span class="production">
                        <span class="textLabel">Производство </span>
                        <img src="<?=$this->config->item('style_url')?>skin/resources/icon_research.gif" alt="Баллы науки"> +0
                    </span>
                </div>
								
                <div class="priests" style="left:<?=$free_px+$workers_px+$special_px+$research_px+20?>px;width:<?=$templer_px?>px">
                    <span class="type">
                        <span class="count"><?=$this->Town_Model->peoples['templer']?></span>
                        <img src="<?=$this->config->item('style_url')?>skin/characters/40h/templer_r.gif" title="Священники" alt="Священники">
                    </span> 
                </div>				
            </div>
				
            <div id="notices">			
                <h4>Примечания:</h4>			
                <p>Никаких происшествий! Поздравляем, развитие города идет самым лучшим образом!</p>
            </div>			
        </div>
						
        <div class="footer"></div>	
    </div>
					
    <div class="contentBox">				
        <h3 class="header">Уровень довольства жизнью</h3>			
        <div class="content">			
            <p>Уровень довольства населения в городе определяется многими факторами. Данное изображение  поможет прояснить проблемы и показать возможности для развития.</p>
            <div id="SatisfactionOverview">
                <div class="positives">
                    <h4>Бонусы</h4>
                    <div class="cat basic">
                        <h5>Основные бонусы</h5>
<?
// Строим полосу плюсов по процентам
    $all_px = 400;   // всего пикселей
    $min_px = 60;    // минимальный размер
    $base_px = $min_px;
    $research_px = $min_px;
    $capital_px = $min_px;
    $ostalos_px = $all_px - $base_px - $research_px - $capital_px; // осталось
    $one_px = $ostalos_px/100;
    $all_plus = $this->Town_Model->plus['base'] + $this->Town_Model->plus['research'] + $this->Town_Model->plus['capital'];
    $base_percent = ($this->Town_Model->plus['base']/$all_plus)*100;
    $research_percent = ($this->Town_Model->plus['research']/$all_plus)*100;
    $capital_percent = ($this->Town_Model->plus['capital']/$all_plus)*100;
?>

                        <div class="base" style="left:100px;width:<?=floor($base_percent*$one_px)+$base_px?>px"><span class="value">+<?=$this->Town_Model->plus['base']?></span> <img src="<?=$this->config->item('style_url')?>skin/icons/city_30x30.gif" width="30" height="30" title="Основной бонус" alt="Основной бонус"></div>
                        <div class="research1" style="left:<?=floor($base_percent*$one_px)+$base_px+100?>px;width:<?=floor($research_percent*$one_px)+$research_px?>px"><span class="value">+<?=$this->Town_Model->plus['research']?></span> <img src="<?=$this->config->item('style_url')?>skin/icons/researchbonus_30x30.gif" width="30" height="30" title="через исследования" alt="через исследования"></div>
                        <div class="capital" style="left:<?=floor($base_percent*$one_px)+$base_px+floor($research_percent*$one_px)+$research_px+100?>px;width:<?=floor($capital_percent*$one_px)+$capital_px?>px"><span class="value">+<?=$this->Town_Model->plus['capital']?></span> <img src="<?=$this->config->item('style_url')?>skin/layout/crown.gif" width="20" height="20" title="Бонус столицы" alt="Бонус столицы"></div>
                    </div>
                    <div class="cat wine">
                        <h5>Вино</h5>
                        <p>В городе нет таверны!</p>
                    </div>
                    <div class="cat culture">
                        <h5>Культура</h5>
                        <p>В городе нет музея!</p>
                    </div>
                </div>

                <div class="negatives">
                    <h4>Отчисления</h4>
                    <div class="cat overpopulation" >
                        <h5>Население:</h5>
<?
    $peoples_percent = ($this->Town_Model->peoples['free']/$this->Town_Model->peoples['max'])*$all_px;
?>
                        <div class="bar" style="left:100px;width:<?=floor($peoples_percent)?>px;"><span class="value">-<?=number_format($this->Town_Model->peoples['all'])?></span></div>
                    </div>
                </div>

								
                <div class="happiness happiness_<?=$this->Data_Model->good_class_by_count($this->Town_Model->good)?>">
                    <h4>Общий уровень довольства:</h4>		
                    <div class="value"><?=number_format($this->Town_Model->good)?></div>
                    <div class="text"><?=$this->Data_Model->good_name_by_count($this->Town_Model->good)?></div>
                </div>
            </div>
						
        </div>
						
        <div class="footer"></div>				
    </div>
</div>