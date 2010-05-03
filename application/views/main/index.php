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
<?if ($this->config->item('game_email')){?>
                                <tr>
                                    <td colspan="3" class="forgotpwd"><a id="lost_password" title="Здесь вы можете запросить новый пароль">Забыли пароль?</a></td>
                                    <td style="font-size:10px; text-align:left; padding:4px 0px 0px 16px;"></td>
                                </tr>
<?}?>
<!--
                                <tr>
                                    <td colspan="4"><img src="design/fb_login_divider.gif" alt=" " /></td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="welt" class="labelwelt">Мир</label></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>
                                        <select name="universe" class="uni" size="1">
                                            <option value="alpha">Alpha</option>
                                        </select>
                                    </td>
                                    <td colspan="2" style="vertical-align: top;">
<script src="http://vkontakte.ru/js/common.js"></script>

<div id="vk_api_transport"></div>
<script type="text/javascript">
  window.vkAsyncInit = function() {
    VK.init({
      apiId: 1868320,
      nameTransportPath: "main/page/xd_receiver/"
    });
  };

  (function() {
    var el = document.createElement("script");
    el.type = "text/javascript";
    el.charset = "utf8";
    el.src = "http://vkontakte.ru/js/api/openapi.js";
    el.async = true;
    document.getElementById("vk_api_transport").appendChild(el);
  }());
</script>
<div id="vk_login" style="margin: 0 auto 20px auto;" onclick="doLogin();"></div> 
                                    </td>
                                </tr>
-->
                            </table>
                        </div>
                    </form>

<script>
$(document).ready(function(){
    $("#index_register").click(function(){
        $('#text').load('<?=$this->config->item('base_url')?>main/page/register/');
    });
<?if ($this->config->item('game_email')){?>
    $("#lost_password").click(function(){
        $('#text').load('<?=$this->config->item('base_url')?>main/page/password/');
    });
<?}?>
});
</script>