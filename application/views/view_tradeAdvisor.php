<div id="mainview">
    <div class="buildingDescription">
        <h1>Мэр</h1>
        <p></p>
    </div>

    <div class="yui-navset">
        <ul class="yui-nav"  >
            <li  class="selected"><a
                href="<?=$this->config->item('base_url')?>game/tradeAdvisor/"
                title="Городские Новости"><em>Городские Новости</em></a></li>
            <li ><a
                href="<?=$this->config->item('base_url')?>game/tradeAdvisorTradeRoute/"
                title="Торговые маршруты"><em>Торговые маршруты</em></a></li>
        </ul>
    </div>

    <div class="contentBox01h">
        <h3 class="header">Текущие события (<?=SizeOf($this->User_Model->town_messages)?>)</h3>
        <div class="content">
            <table cellpadding="0" cellspacing="0" class="table01" id="inboxCity">
                <thead>
                    <tr>
                        <th></th>
                        <th colspan="2">Местоположение</th>
                        <th>Дата</th>
                        <th>Тема</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

<?$message_id = 0?>
<?foreach($this->User_Model->town_messages as $message){?>
                    <tr class="<?if (($message_id % 2) == 0){?>alt<?}else{?>empty<?}?>">
                        <td class="<?if ($message->checked == 0){?>wichtig<?}else{?>empty<?}?>"></td>
                        <td class="city"></td>
                        <td style="white-space:nowrap;">
                            <a title="Перейти в город <?=$this->Data_Model->temp_towns_db[$message->town]->name?>" href="/game/city/<?=$message->town?>/"><?=$this->Data_Model->temp_towns_db[$message->town]->name?></a>
                        </td>
                        <td class="date"><?=date("d.m.Y G:i",$message->date)?></td>
                        <td class="subject"><?=$message->text?></td>
                        <td class="empty"></td>
                    </tr>
<?$message_id++?>
<?}?>

                </tbody>
            </table>
        </div>
        <div class="footer"></div>
    </div>
</div>

<script type="text/javascript">
<!--
 /* IE RTL dirty fix for invisible content foooooooooooo */
   Dom.get("mainview").style.display="block";
//-->
</script>

<?
    $this->db->set('checked', 1);
    $this->db->where(array('user' => $this->User_Model->id));
    $this->db->update($this->session->userdata('universe').'_town_messages');
?>