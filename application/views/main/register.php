<div id="register">
    	<img class="bild1" src="<?=$this->config->item('base_url')?>design/bild1.jpg" width="173" height="85" />
        <img class="bild2" src="<?=$this->config->item('base_url')?>design/bild2.jpg" width="173" height="85" />
        <h1>Добро пожаловать в мир Икариам</h1>
        <p class="desc">Для начала игры необходимо ввести имя, пароль и адрес e-mail и принять Основные Положения.</p>

<?if(SizeOf($this->session->flashdata('errors')) > 0){?>
        <div>
<?foreach ($this->session->flashdata('errors') as $error){?>
        <div class="warning"><?=$error?></div>
<?}?>
        </div>
<?}?>
        <form name="registerForm" action="<?=$this->config->item('base_url')?>" method="post">
            <input name="action" type="hidden" value="register">
            <p class="desc">
    	        <table cellpadding="3" cellspacing="0" id="logindata">
                    <tr>
                        <td><label for="welt" class="labelwelt">Мир</label></td>
                    	<td>
                            <select id="universe" name="universe" class="uni" size="1" onchange="getServerNotice(this.value, 'infotext');">
                                <option value="alpha" >Alpha</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="login" class="labellogin">Имя игрока</label></td>
                        <td><input type='text' name='name' class="startinput"  size='30'></td>
                    </tr>
                    <tr>
                        <td><label for="login" class="labellogin">Пароль</label></td>
                        <td><input type='password' name='password' class="startinput" size='30'></td>
                    </tr>
                    <tr>
                        <td><label for="login" class="labellogin">e-mail</label></td>
                        <td><input type='text' name='email' class="startinput" size='30'></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type=checkbox name="agb" >Я принимаю Основные Положения.</td>
                    </tr>
                </table>
            </p>
            <div id="infotext"></div>
            <input type="submit" class="button" value="Регистрация">
        </form>
</div>