<div id="mainview">
<h1>Баланс</h1>
<br><br>
<table cellspacing="0" cellspacing="0" id="balance" class="table01">
<tr>
	<th class="city"><img src="<?=$this->config->item('style_url')?>skin/layout/icon-city2.gif" /></th>
    <th>Доход</th>
    <th>Содержание</th>
    <th>Кол-во</th>
</tr>
<?
    $summ_dohod = 0;
    $summ_rashod = 0;
    $summ_ostalos = 0;
?>
<?foreach($this->Player_Model->towns as $town){?>
<?

    $summ_dohod = $summ_dohod + $this->Player_Model->peoples_gold[$town->id];
    $summ_rashod = $summ_rashod + $this->Player_Model->army_gold_need[$town->id];
    $summ_ostalos = $summ_ostalos + $this->Player_Model->saldo[$town->id];
?>
    <tr >
        <td class="city"><?=$town->name?></td>
        <td class="value res"><?=number_format($this->Player_Model->peoples_gold[$town->id])?></td>
        <td class="value res"><?=number_format($this->Player_Model->army_gold_need[$town->id])?></td>
        <td class="value res"><?=number_format($this->Player_Model->saldo[$town->id])?></td>
    </tr>
<?}?>
 	<tr class="result">
 		<td class="sigma"><img src="<?=$this->config->item('style_url')?>skin/layout/sigma.gif" /></td>
 		<td class="value res"><?=number_format($summ_dohod)?></td>
 		<td class="value res"><?=number_format($summ_rashod)?></td>
 		<td class="value res"><?=number_format($summ_ostalos)?></td>
 	</tr>
    <tr class="result">
        <td class="sigma">Золото</td>
        <td class="value res"></td>
        <td class="value res"></td>
        <td class="value res"><?=number_format($this->Player_Model->user->gold)?></td>
    </tr>
</table>
<br><br>
</div> 