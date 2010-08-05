<?
    $rangs_count = ceil($param1->num_rows()/100);
?>
<div id="mainview">
    <h1>Топ-лист игры</h1>
    <div class="contentBox01h">
        <h3 class="header"><span class="textLabel">Топ-лист игры</span></h3>
        <div class="content">
            <table class="table01">
            <tr>
                <td width="33%"><img src="<?=$this->config->item('style_url')?>skin/layout/sieger_2.jpg"></td>
                <td width="33%" align="center">
                    <form action="<?=$this->config->item('base_url')?>game/highscore/" method="POST">
                        <div align="center" style="padding: 10px 0;">
                            <select name="highscoreType">
                                <option value="score" <?if($param3['highscoreType']=='score'){?>selected="selected"<?}?>>Общий счет</option>
                                <option value="building_score_main" <?if($param3['highscoreType']=='building_score_main'){?>selected="selected"<?}?>>Строители</option>
                                <option value="building_score_secondary" <?if($param3['highscoreType']=='building_score_secondary'){?>selected="selected"<?}?>>Уровни зданий</option>
                                <option value="research_score_main" <?if($param3['highscoreType']=='research_score_main'){?>selected="selected"<?}?>>Ученые</option>
                                <option value="research_score_secondary" <?if($param3['highscoreType']=='research_score_secondary'){?>selected="selected"<?}?>>Уровень исследований</option>
                                <option value="army_score_main" <?if($param3['highscoreType']=='army_score_main'){?>selected="selected"<?}?>>Генералы</option>
                                <option value="trader_score_secondary" <?if($param3['highscoreType']=='trader_score_secondary'){?>selected="selected"<?}?>>Золото</option>
                                <option value="offense" <?if($param3['highscoreType']=='offense'){?>selected="selected"<?}?>>Баллы атаки</option>
                                <option value="defense" <?if($param3['highscoreType']=='defense'){?>selected="selected"<?}?>>Баллы защиты</option>
                                <option value="trade" <?if($param3['highscoreType']=='trade'){?>selected="selected"<?}?>>Баллы торговли</option>
                                <option value="resources" <?if($param3['highscoreType']=='resources'){?>selected="selected"<?}?>>Ресурсы</option>
                                <option value="donations" <?if($param3['highscoreType']=='donations'){?>selected="selected"<?}?>>Пожертвовать</option>
                            </select>
                            <select name="offset" id='offset'>
                                <option value="-1">Ранг</option>
<?for($i=1;$i<=$rangs_count;$i++){?>
                                <option value="<?=$i-1?>" <?if($param3['offset']==$i-1){?>selected<?}?>><?=(($i*100)-100)+1?>- <?=$i*100?></option>
<?}?>
                            </select>
                            <input type="hidden" name="view" value="highscore" />
                            <input class="button" name="sbm" type="submit" value="Отправить" />
                        </div>
	           </td>
	           	           <td width="33%" align="center">
	               Имя игрока	                   <input type="text" name="searchUser" value="" />
                       <input type="hidden" name="view" value="highscore" />
                   </form>
	           </td>
            </tr>
           </table>
           <p style="font-size: 14px; padding: 0; margin: 0 0 15px 10px;">
 Места в топ-листе
<?switch($param3['highscoreType']){?>
<?case 'building_score_main': echo 'Строители'; break;?>
<?case 'building_score_secondary': echo 'Уровни зданий'; break;?>
<?case 'research_score_main': echo 'Ученые'; break;?>
<?case 'research_score_secondary': echo 'Уровень исследований'; break;?>
<?case 'army_score_main': echo 'Генералы'; break;?>
<?case 'trader_score_secondary': echo 'Золото'; break;?>
<?case 'offense': echo 'Баллы атаки'; break;?>
<?case 'defense': echo 'Баллы защиты'; break;?>
<?case 'trade': echo 'Баллы торговли'; break;?>
<?case 'resources': echo 'Ресурсы'; break;?>
<?case 'donations': echo 'Пожертвовать'; break;?>
<?default: echo 'Общий счет'; break;?>
<?}?> !            </p>
           <table class="table01">
             <tr>
                <th width="15%">Место</th>
                <th width="30%">Имя игрока</th>
                <th width="15%">Альянс</th>
                <th width="20%">Баллы</th>
                <th width="20%">Действия</th>
            </tr>
<?$i = 1;?>
<?$null_user = array()?>
<?foreach ($param2->result() as $user){?>
            <tr class="<?if(!fmod($i,2)){?>alt<?}?><?if($param3['offset']==0){?><?if($i==1){?> first<?}?><?if($i==2){?> second<?}?><?if($i==3){?> third<?}?><?}?><?if($user->id==$this->Player_Model->user->id){?> own<?}?>">
                    <td class="place"><?=$i?></td>
    	            <td class="name"><?=$user->login?></td>
	            <td class="allytag"><!--<a class="allyLink" href="?view=allyPage&oldView=highscore&allyId=648">Wand</a>--></td>
	            <td class="score">
<?switch($param3['highscoreType']){?>
<?case 'score': echo number_format($user->points); break;?>
<?case 'building_score_main': echo number_format($user->points_buildings); break;?>
<?case 'building_score_secondary': echo number_format($user->points_levels); break;?>
<?case 'research_score_main': echo number_format($user->points_research); break;?>
<?case 'research_score_secondary': echo number_format($user->points_complete); break;?>
<?case 'army_score_main': echo number_format($user->points_army); break;?>
<?case 'trader_score_secondary': echo number_format($user->points_gold); break;?>

<?}?>
                    </td>
	            <td class="action"><?if($user->id!=$this->Player_Model->user->id){?><a title="Создать сообщение" href="<?=$this->config->item('base_url')?>game/sendIKMessage/<?=$user->id?>/"><img src="<?=$this->config->item('style_url')?>skin/interface/icon_message_write.gif" alt="Создать сообщение"> </a><?}?></td>
	    </tr>
<?$i++?>
<?}?>
           </table>
        </div>

        <div class="contentBox01h"><div class="content"><p>
                    </p>
        </div></div>

        <div class="footer"></div>
    </div>
</div>
