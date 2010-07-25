<div id="mainview">

    <div id="diplomacyDescription" class="buildingDescription">
        <h1>Советник по дипломатии</h1>
        <p></p>
    </div>
    <div class="diplomacyAdvisorTabs">
        <table cellpadding="0" cellspacing="0" id="tabz">
            <tr>
                <td class="selected"><a href="<?=$this->config->item('base_url')?>game/diplomacyAdvisor/" title="Входящие"><em>Входящие (<?=SizeOf($this->Player_Model->to_user_messages)?>)</em></a></td>
                <td><a href="<?=$this->config->item('base_url')?>game/diplomacyAdvisorOutBox/" title="Исходящие"><em>Исходящие  (<?=SizeOf($this->Player_Model->from_user_messages)?>)</em></a></td>
                <td><a href="<?=$this->config->item('base_url')?>game/diplomacyAdvisorTreaty/" title="Обзор договоров"><em>Договор</em></a></td>
                <td><a href="<?=$this->config->item('base_url')?>game/diplomacyAdvisorAlly/" title="Информация об альянсе"><em>Альянс</em></a></td>
               <!--   <td><a href="?view=diplomacyAdvisorArchive" title="Входящие"><em>Входящие</em></a></td>
                <td><a href="?view=diplomacyAdvisorArchiveOutBox" title="Исходящие"><em>Исходящие</em></a></td>-->
            </tr>
        </table>
    </div>
    <div id="tab1">

<script type="text/javascript" language="javascript">
         function show_hide_menus(ele)    {
           if (document.getElementById('tbl_'+ele).style.display=='')
           {
               document.getElementById('tbl_'+ele).style.display='none';
           }    else    {
               document.getElementById('tbl_'+ele).style.display='';
           }
       }
function imgtoggle(obj){
	if(obj.className=="open"){
		obj.className="close";
		obj.src="<?=$this->config->item('style_url')?>skin/layout/up-arrow.gif";
	}
	else if(obj.className=="close"){
		obj.className="open";
		obj.src="<?=$this->config->item('style_url')?>skin/layout/down-arrow.gif";
	}
	else if(obj.className=="gopen"){
		obj.className="gclose";
		obj.src="<?=$this->config->item('style_url')?>skin/layout/up-arrow.gif";
	}
	else{
		obj.className="gopen";
		obj.src="<?=$this->config->item('style_url')?>skin/layout/down-arrow.gif";
	}
}
function markAsRead(mid, funcname) {
    var newClass = 'entry globalmessage';
    if (!funcname) { funcname = 'markMessageAsRead'; newClass = 'entry'; }
    callback = null;
    sUrl = '<?=$this->config->item('base_url')?>actions/messages/read/' + mid + '/';
    ajaxSendUrl(sUrl);
    document.getElementById('message'+mid).className=newClass;
}
function markAll(command) {
    var allInputs = document.getElementById('deleteMessages').getElementsByTagName('input');
    for (var i=0; i<allInputs.length; i++) {
        if (allInputs[i].getAttribute('type') == "checkbox") {
            if (command == 'all') {
                allInputs[i].checked = true;
            }
            if (command == 'unread'){
                if (allInputs[i].value=='unread'){ allInputs[i].checked = true;  }
                else                             { allInputs[i].checked = false; }
            }
            if (command == 'read'){
                if(allInputs[i].value=='read')   { allInputs[i].checked = true;  }
                else                             { allInputs[i].checked = false; }
            }
            if (command == 'none') {
                allInputs[i].checked = false;
            }
        }
    }
}
</script>
        
        <div id="messages">
            <div class="contentBox01">
                <h3 class="header"><span class="textLabel">Сообщения</span></h3>
                <div class="content">
                    <form action="<?=$this->config->item('base_url')?>actions/messages/delete/0/diplomacyAdvisor/" method="post" name="deleteMessages" id="deleteMessages">
                        <table cellpadding="0" cellspacing="0" class="table01" id="messages"  style="width:100%;margin:0px;border:none;">
                            <tr>
                                <th>Действие</th>
                                <th></th>
                                <th>Отправитель</th>
                                <th>Тема</th>
                                <th>Город</th>
                                <th>Дата</th>
                            </tr>

<?foreach($this->Player_Model->to_user_messages as $message){?>
<?
    $this->Data_Model->Load_User($message->from);
    $user = $this->Data_Model->temp_users_db[$message->from];
    $this->Data_Model->Load_Town($user->capital);
    $town = $this->Data_Model->temp_towns_db[$user->capital];
    $this->Data_Model->Load_Island($town->island);
    $island = $this->Data_Model->temp_islands_db[$town->island];
?>

                            <tr id="message<?=$message->id?>" onMouseOver="this.bgColor='#ECD5AC'" onMouseOut="this.bgColor='#FDF7DD'" title="Нажмите для развертывания/свертывания сообщения" class="entry <?if($message->checked_to == 0){?>new<?}?>" <?if($message->checked_to == 0){?>onClick ="markAsRead(<?=$message->id?>);"<?}?>>
                             	<td><input type="checkbox" name="deleteId[<?=$message->id?>]" value="read" /></td>
                                <td onclick="show_hide_menus('mail<?=$message->id?>');show_hide_menus('reply<?=$message->id?>');imgtoggle(getElementById('button<?=$message->id?>'));">
                                    <img class="open" alt="" id="button<?=$message->id?>" name="button<?=$message->id?>" src="<?=$this->config->item('style_url')?>skin/layout/down-arrow.gif">
                                </td>
                                <td onclick="show_hide_menus('mail<?=$message->id?>');show_hide_menus('reply<?=$message->id?>');imgtoggle(getElementById('button<?=$message->id?>'));"><a href="#"><?=$user->login?></a></td>
                                <td class="subject" onclick="show_hide_menus('mail<?=$message->id?>');show_hide_menus('reply<?=$message->id?>');imgtoggle(getElementById('button<?=$message->id?>'));">Сообщение</td>
                                <td title="К городу отправителя"><a href="<?=$this->config->item('base_url')?>game/island/<?=$island->id?>/<?=$town->id?>/"><?=$town->name?> [<?=$island->x?>:<?=$island->y?>]</a></td>
                                <td  onclick="show_hide_menus('mail<?=$message->id?>');show_hide_menus('reply<?=$message->id?>');imgtoggle(getElementById('button<?=$message->id?>'));"><?=date("d.m.Y G:i",$message->date)?></td>
                            </tr>
                            <tr id="tbl_mail<?=$message->id?>" style="display:none;" class="text">
                              	<td colspan="6" class="msgText">
                                  	<div style="overflow: auto; width: 100%;"><br><?=$message->text?></div>
                              	</td>
                            </tr>
                            <tr id="tbl_reply<?=$message->id?>" style="display:none;" class="text">
                                 <td colspan="6" class="reply">
                                    <span style="float:left;padding:5px;margin-left:5px;">
                                            <a class="button" href="<?=$this->config->item('base_url')?>game/sendIKMessage/<?=$message->from?>/<?=$message->id?>/">Ответ</a>
                                            <a class="button" href="<?=$this->config->item('base_url')?>actions/messages/delete/<?=$message->id?>/diplomacyAdvisor/">Удалить</a>
                                    </span>
                                     <span style="float:right;padding:5px;margin-right:5px;"><a href="<?=$this->config->item('base_url')?>actions/messages/archive/<?=$message->id?>/" class="button">Поместить в архив</a>
                                            &nbsp; (<span class="costAmbrosia" style="padding-top:5px;padding-bottom:5px;font-weight:bold;paddig-left:5px;padding-right:22px;background-image:url(<?=$this->config->item('style_url')?>skin/premium/ambrosia_icon.gif);background-repeat:no-repeat;background-position:100% 50%;###">1</span>)
                                     </span>
                                 </td>
                            </tr>
<?}?>
                                                        
                            <tr>
                                <td colspan="5" class="paginator">
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:left;">
                                    <a href="javascript:markAll('all');">Все</a> |
                                    <a href="javascript:markAll('read');">Читать</a> |
                                    <a href="javascript:markAll('unread');">Не прочитано</a> |
                                    <a href="javascript:markAll('none');">Никто</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="selection" colspan="6" style="text-align:left;" width="50%">
                                    <input type="hidden" name="pos" value="inbox">
                                    <input type="submit" name="666" value="Удалить"         class="button">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="footer"></div>
            </div>

            <div class="dynamic" id="viewDiplomacyImperium" style="z-index:1;">
                <h3 class="header">Архив сообщений</h3>
                <div class="content">
                    <div class="centerButton">
                        <div>
                            <a class="button" href="<?=$this->config->item('base_url')?>game/diplomacyAdvisorArchive/" title="Входящие"><b>Входящие</b></a>
                            <a class="button" href="<?=$this->config->item('base_url')?>game/diplomacyAdvisorArchiveOutBox/" title="Исходящие"><b>Исходящие</b></a>
                        </div>
                    </div>
                </div>
                <div class="footer"></div>
            </div>
        </div>
    </div>
</div>
<?
    //$this->db->set('checked', 1);
    //$this->db->where(array('to' => $this->Player_Model->user->id));
    //$this->db->update($this->session->userdata('universe').'_user_messages');
?>