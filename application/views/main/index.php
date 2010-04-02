                    <img class="bild1" src="<?=$this->config->item('base_url')?>design/bild1.jpg" width="173" height="85">
                    <img class="bild2" src="<?=$this->config->item('base_url')?>design/bild2.jpg" width="173" height="85">
                    <h1>Жизнь в древнем мире!</h1>
                    <p class="desc">Ласковый шепот прибоя, белый песчаный берег и яркое солнце!
                        На маленьком острове где-то в Средиземноморье возникает древняя цивилизация.
                        Под Вашим лидерством начинается эра открытий и процветания.
                        Добро пожаловать в Икариам
                    </p>
                    <div class="joinbutton">
                        <a href="#" id="index_register" title="Давай! Нажми меня!">Играть бесплатно сейчас!</a>
                    </div>
                    <form id="loginForm" name="loginForm" action="<?=$this->config->item('base_url')?>" method="post">
                        <input name="action" type="hidden" value="login">
                        <div id="formz">
                            <table cellpadding="0" cellspacing="0" id="logindata">
                                <tr>
                                    <td><label for="welt" class="labelwelt">Мир</label></td>
                                    <td><label for="login" class="labellogin">Имя игрока</label></td>
                                    <td><label for="pwd" class="labelpwd">Пароль</label></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="universe" class="uni" size="1">
                                            <option value="alpha">Alpha</option>
                                        </select>
                                    </td>
                                    <td><input id="login" name="name" type="text" class="login"></td>
                                    <td><input id="pwd"  name="password" type="password" class="pass"></td>
                                    <td><input type="submit" class="button" value="Вход"></td>
                                </tr>
                            </table>
                        </div>
                    </form>

<script>
$(document).ready(function(){
    $("#index_register").click(function(){
        $('#text').hide();
        $('#text').load('<?=$this->config->item('base_url')?>main/page/register/');
        $('#text').fadeIn();
    });
});
</script>