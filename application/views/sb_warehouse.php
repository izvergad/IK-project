<?if ($this->Town_Model->buildings[$position]['type'] == 6){?>
<?$level = $this->Town_Model->buildings[$position]['level']?>

    <div id="information" class="dynamic">
     	<h3 class="header">Безопасность от краж увеличена</h3>
	     <div class="content">
	     	<img src="<?=$this->config->item('style_url')?>skin/premium/safecapacity.gif" />
	     	<p>Несколько тайников здесь, между двойными стенами складов, увеличивают вашу безопасность от кражи на 100 %!</p>
	     	<div class="centerButton">
            	<a href="<?=$this->config->item('base_url')?>game/premium/" class="button">Просмотр.</a>
      		</div>
	     </div>
	     <div class="footer"></div>
     </div>

    <div id="information" class="dynamic">
        <h3 class="header">На уровне <?=$level+1?></h3>
    	<div class="content">
            <table class="safeinnextlevel">
            <tr>
    	        <th>Ресурс</th>
                <th>Гарант.</th>
                <th>Вместимость</th>
            </tr>
                    <tr>
                    <td class="resource"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wood.gif" title="Стройматериалы" alt="Стройматериалы" /></td>
                    <td class="amount">+<?=number_format(($level+1)*80)?></td>
                    <td class="amount">+<?=number_format(($level+1)*8000)?></td>
                </tr>
                    <tr>
                    <td class="resource"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_wine.gif" title="Виноград" alt="Виноград" /></td>
                    <td class="amount">+<?=number_format(($level+1)*80)?></td>
                    <td class="amount">+<?=number_format(($level+1)*8000)?></td>
                </tr>
                    <tr>
                    <td class="resource"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_marble.gif" title="Мрамор" alt="Мрамор" /></td>
                    <td class="amount">+<?=number_format(($level+1)*80)?></td>
                    <td class="amount">+<?=number_format(($level+1)*8000)?></td>
                </tr>
                    <tr>
                    <td class="resource"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_glass.gif" title="Хрусталь" alt="Хрусталь" /></td>
                    <td class="amount">+<?=number_format(($level+1)*80)?></td>
                    <td class="amount">+<?=number_format(($level+1)*8000)?></td>
                </tr>
                    <tr>
                    <td class="resource"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_sulfur.gif" title="Сера" alt="Сера" /></td>
                    <td class="amount">+<?=number_format(($level+1)*80)?></td>
                    <td class="amount">+<?=number_format(($level+1)*8000)?></td>
                </tr>
                </table>
        </div>
        <div class="footer"></div>
    </div>
<?}?>