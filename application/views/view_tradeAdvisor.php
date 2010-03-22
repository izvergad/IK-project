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

<?foreach($this->User_Model->town_messages as $message){?>
                    <tr class="<?if ((SizeOf($this->User_Model->town_messages) %2) == 0){?>empty<?}else{?>alt<?}?>">
                        <td class="empty"></td>
                        <td class="city"></td>
                        <td style="white-space:nowrap;">
                            <a title="Перейти в город <?=$this->Data_Model->temp_towns_db[$message->town]->name?>" href="/game/city/<?=$message->town?>/"><?=$this->Data_Model->temp_towns_db[$message->town]->name?></a>
                        </td>
                        <td class="date"><?=date("d.m.Y G:i",$message->date)?></td>
                        <td class="subject"><?=$message->text?></td>
                        <td class="empty"></td>
                    </tr>
<?}?>
                    
                      <!--                         <tr>
                        	<td class="empty"></td>
               		   		<td class="city"></td>
                            <td style="white-space:nowrap;">
                                <a title="Перейти в город Полис" href="?view=city&id=90580">
                                    Полис</a>
                            </td>
            	    	    <td class="date">19.03.2010 14:30</td>
              	    		<td class="subject">Уровень здания "<a href="/index.php?view=academy&id=90580&position=9&currentCity=90580">Академия</a>" увеличен до 2!</td>
        					<td class="empty"></td>
        	            </tr>
                                         <tr class="alt">
                        	<td class="empty"></td>
               		   		<td class="city"></td>
                            <td style="white-space:nowrap;">
                                <a title="Перейти в город Полис" href="?view=city&id=90580">
                                    Полис</a>
                            </td>
            	    	    <td class="date">19.03.2010 12:54</td>
              	    		<td class="subject">Строительство "<a href="/index.php?view=port&id=90580&position=1&currentCity=90580">Торговый порт</a>" завершено!</td>
        					<td class="empty"></td>
        	            </tr>
                                            <tr>
                        	<td class="empty"></td>
               		   		<td class="city"></td>
                            <td style="white-space:nowrap;">
                                <a title="Перейти в город Полис" href="?view=city&id=90580">
                                    Полис</a>
                            </td>
            	    	    <td class="date">19.03.2010 12:22</td>
              	    		<td class="subject">Строительство "<a href="/index.php?view=wall&id=90580&position=14&currentCity=90580">Городская стена</a>" завершено!</td>
        					<td class="empty"></td>
        	            </tr>
                                            <tr class="alt">
                        	<td class="empty"></td>
               		   		<td class="city"></td>
                            <td style="white-space:nowrap;">
                                <a title="Перейти в город Полис" href="?view=city&id=90580">
                                    Полис</a>
                            </td>
            	    	    <td class="date">19.03.2010 8:15</td>
              	    		<td class="subject">Строительство "<a href="/index.php?view=barracks&id=90580&position=5&currentCity=90580">Казарма</a>" завершено!</td>
        					<td class="empty"></td>
        	            </tr>
                                            <tr>
                        	<td class="empty"></td>
               		   		<td class="city"></td>
                            <td style="white-space:nowrap;">
                                <a title="Перейти в город Полис" href="?view=city&id=90580">
                                    Полис</a>
                            </td>
            	    	    <td class="date">19.03.2010 8:05</td>
              	    		<td class="subject">Строительство "<a href="/index.php?view=academy&id=90580&position=9&currentCity=90580">Академия</a>" завершено!</td>
        					<td class="empty"></td>
        	            </tr>
                    -->

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