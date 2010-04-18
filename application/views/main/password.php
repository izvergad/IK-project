<div id="pwd">
    	<img class="bild1" src="<?=$this->config->item('base_url')?>design/bild1.jpg" width="173" height="85">
    	<img class="bild2" src="<?=$this->config->item('base_url')?>design/bild2.jpg" width="173" height="85">
        <h1>Запросить пароль</h1>
        <p class="desc">
<?if(SizeOf($this->session->flashdata('errors')) > 0){?>
<?foreach ($this->session->flashdata('errors') as $error){?>
        <div class="warning"><?=$error?></div>
<?}?>
<?}elseif($this->session->flashdata('sended') == true){?>
        <img src="<?=$this->config->item('base_url')?>design/ok-neu.gif">Случайно сгенерированный пароль отправлен по указанному адресу e-mail.       		<br />
<?}else{?>
Введите адрес e-mail игрового аккаунта.<br>
<?}?>
        </p>
        <form name="registerForm" action="<?=$this->config->item('base_url')?>" method="post">
	        <input type="hidden" name="action" value="sendPassword">
	        <table cellpadding="3" cellspacing="0" id="logindata">
    	        <tr>
                	<td><label for="welt" class="labelwelt">Мир</label></td>
                	<td>
                        <select name="universe" class="uni" size="1">
                            <option value="alpha">Alpha</option>
                        </select>
                    </td>
    	        </tr>
                <tr>
                    <td><label for="login" class="labellogin">e-mail</label></td>
                    <td><input type="text" name="email" class="startinput" size="30"></td>
                </tr>
                </table>
            <div id="demand"><input type="submit" class="button" value="Запросить пароль"></div>
        </form>

</div>