<?
    for($i = 1; $i < 14; $i++)
    {
        $parametr = 'res1_'.$i;
        if ($this->Player_Model->research->$parametr == 0)
        {
            $ways[1] = $this->Data_Model->get_research(1,$i,$this->Player_Model->research);
            break;
        }
    }
    if ($this->Player_Model->research->res1_14 > 0)
    {
        $ways[1] = $this->Data_Model->get_research(1,14,$this->Player_Model->research);
    }
    for($i = 1; $i < 15; $i++)
    {
        $parametr = 'res2_'.$i;
        if ($this->Player_Model->research->$parametr == 0)
        {
            $ways[2] = $this->Data_Model->get_research(2,$i,$this->Player_Model->research);
            break;
        }
    }
    if ($this->Player_Model->research->res2_15 > 0)
    {
        $ways[2] = $this->Data_Model->get_research(2,15,$this->Player_Model->research);
    }
    for($i = 1; $i < 16; $i++)
    {
        $parametr = 'res3_'.$i;
        if ($this->Player_Model->research->$parametr == 0)
        {
            $ways[3] = $this->Data_Model->get_research(3,$i,$this->Player_Model->research);
            break;
        }
    }
    if ($this->Player_Model->research->res3_16 > 0)
    {
        $ways[3] = $this->Data_Model->get_research(3,16,$this->Player_Model->research);
    }
    for($i = 1; $i < 14; $i++)
    {
        $parametr = 'res4_'.$i;
        if ($this->Player_Model->research->$parametr == 0)
        {
            $ways[4] = $this->Data_Model->get_research(4,$i,$this->Player_Model->research);
            break;
        }
    }
    if ($this->Player_Model->research->res4_14 > 0)
    {
        $ways[4] = $this->Data_Model->get_research(4,14,$this->Player_Model->research);
    }
?>
<div id="mainview">
    <div class="buildingDescription">
        <h1>Советник по исследованиям</h1>
        <p></p>
    </div>
    <div class="contentBox01h" id="currentResearch">
        <h3 class="header"><span class="textLabel">Текущее исследование</span></h3>
        <div class="content">
            <ul class="researchTypes">
<?for ($way = 1; $way <= 4; $way++){?>
                <li class="researchType ">
                    <div class="researchInfo" style="width:100px; min-height:120px;">
                        <h4><a href="<?=$this->config->item('base_url')?>game/researchDetail/1/<?=$ways[$way]['id']?>/"><?=$ways[$way]['name']?></a></h4>
                        <div class="leftBranch">
<?switch($way){?>
<?case 1:?>
<img src="<?=$this->config->item('style_url')?>skin/layout/changeResearchSeafaring.jpg">
<?break;?>
<?case 2:?>
<img src="<?=$this->config->item('style_url')?>skin/layout/changeResearchEconomy.jpg">
<?break;?>
<?case 3:?>
<img src="<?=$this->config->item('style_url')?>skin/layout/changeResearchKnowledge.jpg">
<?break;?>
<?case 4:?>
<img src="<?=$this->config->item('style_url')?>skin/layout/changeResearchMilitary.jpg">
<?break;?>
<?}?>
                            <div class="researchTypeLabel">
                                <div class="unitcount">
                                    <span class="textLabel">
                                        <span class="before"></span>
<?switch($way){?>
<?case 1:?>
Мореходство
<?break;?>
<?case 2:?>
Экономика
<?break;?>
<?case 3:?>
Наука
<?break;?>
<?case 4:?>
Милитаризм
<?break;?>
<?}?>
                                        <span class="after"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <p><?=$ways[$way]['desc']?></p>                   
<?if ($ways[$way]['need_id'] > 0){?>
<?$need = $this->Data_Model->get_research($ways[$way]['need_way'],$ways[$way]['need_id'],$this->Player_Model->research)?>
                        <div class="researchButton2">
                        По крайней мере одно из требуемых исследований не были изучены (Следующее требуемое: <a href="<?=$this->config->item('base_url')?>game/researchDetail/<?=$ways[$way]['need_way']?>/<?=$ways[$way]['need_id']?>/"><?=$need['name']?></a>)
                        </div>
<?}else{?>
<?if($ways[$way]['points'] > $this->Player_Model->research->points){?>
                        <div class="researchButton2">
                        Не хватает исследовательских баллов.
                        </div>
                        <div class="costs">
                            <h5>Стоимость:</h5>
                            <ul class="resources">
                                <li class="researchPoints"><?=number_format($ways[$way]['points'])?></li>
                            </ul>
                        </div>
<?}else{?>
                        <div class="researchButton">
                            <a class="button build" style="padding-left:3px;padding-right:3px;"  href="<?=$this->config->item('base_url')?>actions/doResearch/<?=$way?>/<?=$ways[$way]['id']?>/">
                                <span class="textLabel">Исследовать</span>
                            </a>			
                        </div>			
                        <div class="costs">		
                            <h5>Стоимость:</h5>		
                            <ul class="resources">		
                                <li class="researchPoints"><?=number_format($ways[$way]['points'])?></li>
                            </ul>			
                        </div>
<?}?>
<?}?>
                    </div>
                </li>
<?}?>
			</ul>
        </div>
		<div class="footer"></div>
	</div>
</div>