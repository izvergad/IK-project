<?if ($position == 0 and $page != 'townHall')
  {
    $this->Player_Model->Game_Error('Торговый порт еще не построен!');
  }
?>
<div id="mainview">
<?include_once('building_description.php')?>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Купить торговое судно</span></h3>
        <div class="content">
            <ul id="units">
                <li class="unit">
                    <div class="unitinfo">
                        <h4>Сухогруз</h4>
                        <a title="Узнать больше о Сухогруз..." href="<?=$this->config->item('base_url')?>game/shipDescription/23/">
                            <img src="<?=$this->config->item('style_url')?>skin/characters/fleet/120x100/ship_transport_r_120x100.gif">
                        </a>
                        <div class="unitcount"><span class="textLabel">Доступно: </span><?=$this->Player_Model->user->transports?></div>
                        <p>Торговые корабли - один из важнейших элементов для развития империи. Их можно использовать как для перевозки мирных товаров, так и для военных нужд.</p>
                    </div>
                    <label for="textfield_">Купить торговое судно:</label>

                    <div class="forminput">Максимум: 160<br>
<?if($this->Player_Model->user->gold >= $this->Data_Model->transport_cost_by_count($this->Player_Model->user->transports)){?>
                        <div class="leftButton">
                            <a href="<?=$this->config->item('base_url')?>actions/transporter/<?=$position?>/" class="button bigButton">Купить торговое судно</a>
                        </div>
<?}else{?>
Недостаточно ресурсов
<?}?>
                    </div>
                    <div class="costs">
                        <ul class="resources">
<?if($this->Data_Model->transport_cost_by_count($this->Player_Model->user->transports) > 0){?>
                            <li class="gold"><span class="textLabel">Золото: </span><?=number_format($this->Data_Model->transport_cost_by_count($this->Player_Model->user->transports))?></li>
<?}?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="footer"></div>
    </div>

    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Отослать торговое судно</span></h3>
        <div class="content">
            <ul class="cities">
            </ul>
        </div>
        <div class="footer"></div>
    </div>

    <div class="contentBox01h" style="z-index:100">
        <h3 class="header"><span class="textLabel">Флоты на загрузке</span></h3>
        <div class="content master">
            <div class="tcap">Мои торговые корабли</div>
            <p>Нет зарегистрированных кораблей в порту</p>
            <div class="tcap">Иностранные корабли</div>
            <p>Нет зарегистрированных кораблей в порту</p>
        </div>
        <div class="footer"></div>
    </div>

    <div class="contentBox01h" style="z-index:50;">
        <h3 class="header"><span class="textLabel">Прибывающие торговцы</span></h3>
        <div class="content master"><p>Нет зарегистрированных кораблей в порту</p></div>
        <div class="footer"></div>
    </div> 
</div>