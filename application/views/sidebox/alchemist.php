<div id="information" class="dynamic">
    <h3 class="header">На уровне <?=$this->Player_Model->levels[$this->Player_Model->town_id][20]+1?></h3>
	<div class="content">
        <table width="100%">
            <tr>
    	        <th class="center"><b>Ресурс</b></th>
    	        <th class="center"><b>Бонус</b></th>
            </tr>
            <tr>
                <td class="center"><img src="<?=$this->config->item('style_url')?>skin/resources/icon_sulfur.gif" /></td>
                <td class="center">+<?=($this->Player_Model->levels[$this->Player_Model->town_id][20]+1)*2?>.00%</td>
            </tr>
        </table>
    </div>
    <div class="footer"></div>
</div>