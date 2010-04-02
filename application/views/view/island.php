
<div id="mainview" class="island<?=$this->Island_Model->island->type?>">
    <h3>Города на острове <?=$this->Island_Model->island->name?></h3>
    <ul id="cities">

<?for ($i = 0; $i <=15; $i++){?>

<?if ($this->Island_Model->towns[$i] == false){?>
        <li id="cityLocation<?=$i?>" class="cityLocation buildplace">
            <div class="claim"></div>
            <a href="<?=$this->config->item('base_url')?>game/colonize/<?=$this->Island_Model->island->id?>/<?=$i?>/" title="Хотите основать здесь колонию?">
                <span class="textLabel">
                    <span class="before"></span>Стройплощадка
                    <span class="after"></span>
                </span>
            </a>
        </li>
<?}else{?>
<? $level = $this->Island_Model->towns[$i]->pos0_level?>

<?if ($this->Island_Model->towns[$i]->user == $this->Player_Model->user->id){?>)

        <li id="cityLocation<?=$i?>" class="cityLocation city level1">
            <div class="ownCityImg"></div>
            <div class="selectimg"></div>
            <a href="#" id="city_149657" onclick="selectCity(<?=$i?>, <?=$this->Island_Model->towns[$i]->id?>, 1); selectGroup.activate(this, 'cities'); return false;">
                <span class="textLabel">
                    <span class="before"></span><?=$this->Island_Model->towns[$i]->name?>
                    <span class="after"></span>
                </span>
                <div class="noob"></div>
            </a>
            <ul class="cityinfo">
                <li class="name"><span class="textLabel">Имя: </span><?=$this->Island_Model->towns[$i]->name?></li>
                <li class="citylevel"><span class="textLabel">Размер: </span><?=$level?></li>
                <li class="owner"><span class="textLabel">Игрок: </span><?=$this->Island_Model->users[$i]->login?></li>
                <li class="name"><span class="textLabel">Баллы: </span>0</li>
                <li class="ally"><span class="textLabel">Альянс: </span>-</li>
                <li class="noobModeInfo">Игрок под защитой богов.</li>
            </ul>
            <ul class="cityactions">
            </ul>
        </li>
<?}?>

<?}?>
<?}?>
<?if($this->Island_Model->island->id == $this->Player_Model->island_id){?>
        <li id="barbarianVilliage">
            <a href="#" id="barbarianLink" onclick="selectBarbarianVillage(); selectGroup.activate(this, 'cities'); return false;"> </a>
            <ul class="cityinfo" id="barbarianInformation">
                <li class="name"><span class="textLabel">Имя: </span>Деревня Варваров</li>
                <li class="citylevel"><span class="textLabel">Размер: </span>1</li>
                <li class="name"><span class="textLabel">Варвары: </span>1</li>
            </ul>
            <ul class="cityactions" id="barbarianActions">
<?if(($this->Player_Model->armys[$this->Player_Model->town_id]->phalanx > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->steamgiant > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->spearman > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->swordsman > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->slinger > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->archer > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->marksman > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->ram > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->catapult > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->mortar > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->gyrocopter > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->bombardier > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->cook > 0) or
     ($this->Player_Model->armys[$this->Player_Model->town_id]->medic > 0)){?>
                <li class="plunder">
                    <a href="<?=$this->config->item('base_url')?>game/plunder/0/" title="Набег">
                        <span class="textLabel">Набег</span>
                    </a>
                </li>
<?}else{?>
                <li class="plunder disabled" title="Войска/торговые суда для набега недоступны!">
                    <span class="textLabel">Набег</span>
                </li>
<?}?>    
            </ul>
        </li>
<?}?>
    </ul>

    <h3>Достопримечательности на острове <?=$this->Island_Model->island->name?></h3>
    <ul id="islandfeatures">
        <li class="<?=$this->Data_Model->resource_class_by_type(0)?> level<?=$this->Island_Model->island->wood_level?>">
<?$link_wood = ($this->Island_Model->island->id == $this->Player_Model->island_id) ? $this->config->item('base_url').'game/resource/'.$this->Island_Model->island->id.'/' : '#'?>
<?$link_trade = ($this->Island_Model->island->id == $this->Player_Model->island_id) ? $this->config->item('base_url').'game/tradegood/'.$this->Island_Model->island->id.'/' : '#'?>
<?$link_wonder = ($this->Island_Model->island->id == $this->Player_Model->island_id) ? $this->config->item('base_url').'game/wonder/'.$this->Island_Model->island->id.'/' : '#'?>
<?$link_forum = ($this->Island_Model->island->id == $this->Player_Model->island_id) ? $this->config->item('base_url').'game/islandBoard/'.$this->Island_Model->island->id.'/' : '#'?>

            <a href="<?=$link_wood?>" title="<?=$this->Data_Model->island_building_by_resource(0)?> <?=$this->Island_Model->island->wood_level?>">
                <span class="textLabel"><?=$this->Data_Model->island_building_by_resource(0)?></span>
            </a>

        </li>
        <li id="tradegood"  class="<?=$this->Data_Model->resource_class_by_type($this->Island_Model->island->trade_resource)?> level<?=$this->Island_Model->island->trade_level?>">
            <a href="<?=$link_trade?>" title="<?=$this->Data_Model->island_building_by_resource($this->Island_Model->island->trade_resource)?> <?=$this->Island_Model->island->trade_level?>">
                <span class="textLabel"><?=$this->Data_Model->island_building_by_resource($this->Island_Model->island->trade_resource)?></span>
            </a>
        </li>
<?if($this->Island_Model->island->wonder > 0){?>
        <li id="wonder" class="wonder<?=$this->Island_Model->island->wonder?>">
            <a href="<?=$link_wonder?>" title="<?=$this->Data_Model->get_wonder_by_type($this->Island_Model->island->wonder)?>">
                <span class="textLabel"><?=$this->Data_Model->get_wonder_by_type($this->Island_Model->island->wonder)?></span>
            </a>
        </li>
<?}?>
        <li class="forum"><a title="Форум" href="<?=$link_forum?>">
                <span class="textLabel">Форум</span>
            </a>
        </li>
    </ul>
</div> 