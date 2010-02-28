
<div id="mainview" class="island<?=$this->Island_Model->island->type?>">
    <h3>Города на острове <?=$this->Island_Model->island->name?></h3>
    <ul id="cities">

<?for ($i = 0; $i <=15; $i++){?>

<?if ($this->Island_Model->towns[$i] == false){?>
        <li id="cityLocation<?=$i?>" class="cityLocation buildplace">
            <div class="claim"></div>
            <a href="/game/colonize/<?=$this->Island_Model->island->id?>/<?=$i?>/" title="Хотите основать здесь колонию?">
                <span class="textLabel">
                    <span class="before"></span>Стройплощадка
                    <span class="after"></span>
                </span>
            </a>
        </li>
<?}else{?>
<? $level = substr($this->Island_Model->towns[$i]->buildings, 2,1)?>

<?if ($this->Island_Model->towns[$i]->user == $this->User_Model->id){?>)

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

        <li id="barbarianVilliage">
            <a href="#" id="barbarianLink" onclick="selectBarbarianVillage(); selectGroup.activate(this, 'cities'); return false;"> </a>
            <ul class="cityinfo" id="barbarianInformation">
                <li class="name"><span class="textLabel">Имя: </span>Деревня Варваров</li>
                <li class="citylevel"><span class="textLabel">Размер: </span>1</li>
                <li class="name"><span class="textLabel">Варвары: </span>1</li>
            </ul>
            <ul class="cityactions" id="barbarianActions">
                <li class="plunder disabled" title="Войска/торговые суда для набега недоступны!">
                    <span class="textLabel">Набег</span>
                </li>
            </ul>
        </li>
    </ul>

    <h3>Достопримечательности на острове <?=$this->Island_Model->island->name?></h3>
    <ul id="islandfeatures">
        <li class="wood level14">
            <a href="/game/resource/resource/<?=$this->Island_Model->island->id?>/" title="Лес 14">
                <span class="textLabel">Лес</span>
            </a>
        </li>
        <li id="tradegood"  class="crystal level14">
            <a href="/game/noluxury/tradegood/<?=$this->Island_Model->island->id?>/" title="Шахта добычи хрусталя 14">
                <span class="textLabel">Шахта добычи хрусталя</span>
            </a>
        </li>
        <li id="wonder" class="wonder5">
            <a href="/game/wonder/<?=$this->Island_Model->island->id?>/" title="Храм Гермеса">
                <span class="textLabel">Храм Гермеса</span>
            </a>
        </li>
        <li class="forum"><a title="Форум" href="/game/islandBoard/<?=$this->Island_Model->island->id?>/">
                <span class="textLabel">Форум</span>
            </a>
        </li>
    </ul>
</div> 