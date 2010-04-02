<?
    $position = $param1;
    if($position == 0 or isset($this->Data_Model->temp_towns_db[$position])){
    if(isset($this->Data_Model->temp_towns_db[$position]) and $this->Data_Model->temp_towns_db[$position]->user == $this->Player_Model->user->id)
    {
        $this->Player_Model->Game_Error('Невозможно ограбить свой город!');
    }
?>
<div id="breadcrumbs">
    <h3>Вы здесь:</h3>
    <a href="<?=$this->config->item('base_url')?>game/worldmap_iso/" title="Назад к карте мира">
        <img src="<?=$this->config->item('style_url')?>skin/layout/icon-world.gif" alt="Мир">
    </a>
    <span>&nbsp;&gt;&nbsp;</span>
    <a href="<?=$this->config->item('base_url')?>game/island/" class="island" title="Назад к острову"><?=$this->Player_Model->now_island->name?>[<?=$this->Player_Model->now_island->x?>:<?=$this->Player_Model->now_island->y?>]</a>
    <span>&nbsp;&gt;&nbsp;</span>
    <span class="city"><?if($position == 0){?>Деревня Варваров<?}else{?><?=$this->Data_Model->temp_towns_db[$position]->name?><?}?></span>
</div>
<?}else{
    $this->User_Model->Game_Error('Город не найден!');
}?>
