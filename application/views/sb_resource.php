<?
$cost = $this->Data_Model->island_cost(0,$this->Island_Model->levels[0]);
$need_wood = $cost['wood'] - $this->Island_Model->resources[0];
?>

<div id="resUpgrade" class="dynamic">
    <h3 class="header">Лесопилка
        <a class="help" href="/game/informations/10012/" title="Помощь">
            <span class="textLabel">Нужна помощь?</span>
        </a>
    </h3>

    <div class="content">
        <img src="<?=$this->config->item('style_url')?>skin/resources/img_wood.jpg" alt="">
        <div class="buildingLevel">
            <span class="textLabel">Уровень: </span><?=$this->Island_Model->levels[0]?>
        </div>
        <h4>Необходимо для след. уровня:</h4>
        <ul class="resources">
            <li class="wood"><span class="textLabel">Стройматериалы: </span><?=number_format($need_wood)?></li>
        </ul>
        <h4>В наличии:</h4>
        <div>
            <ul class="resources">
                <li class="wood"><span class="textLabel">Стройматериалы: </span><?=number_format($this->Island_Model->resources[0])?></li>
            </ul>
        </div>

        <form id="donateForm" action="/actions/resources/<?=$this->Island_Model->island->id?>/"  method="POST">
            <div id="donate">
                <label for="donateWood">Пожертвовать:</label>
                <input type="hidden" name="id" value="<?=$this->Island_Model->island->id?>">
                <input type="hidden" name="type" value="resource">
                <input type="hidden" name="action" value="IslandScreen">
                <input type="hidden" name="function" value="donate">
                <input id="donateWood" name="donation" type="text" autocomplete="off" class="textfield">
                <a href="#setmax" title="Пожертвовать макс." onClick="Dom.get('donateWood').value=<?=floor($this->Town_Model->resources['wood'])?>;">max</a>
                <div class="centerButton">
                    <input type="submit" class="button" value="Улучшить">
                </div>
            </div>
        </form>

    </div>
    <div class="footer"></div>
</div> 