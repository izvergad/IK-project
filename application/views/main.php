<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<meta name="language" content="ru">
		<meta name="Description" content="Икариам - это бесплатная браузерная игра. Задача игроков - управлять своим собственным народом в древнем мире, строить города, вести торговлю, завоевывать острова.">
		<title>Икариам - Бесплатная браузерная игра</title>
                <link href="/start.css" rel="stylesheet" type="text/css" media="screen">
    </head>
    <body>
        <div id="headback">
            <div id="headlogo">
            </div>

            <div id="main">
                <div id="wrapper">
                    <div id="links">
                        <a href="/" title="Ко входу">Вход</a>
                        <a href="/main/register/" title="Регистрация!">Регистрация</a>
                        <a href="/main/tour/" title="Небольшой тур по миру Ikariam">Тур по игре</a>
                        <a href="/forum/" target="_blank" title="На форум">Форум</a>
                    </div>
                </div>
                <div id="text">
                    <img class="bild1" src="/design/bild1.jpg" width="173" height="85">
                    <img class="bild2" src="/design/bild2.jpg" width="173" height="85">
                    <h1>Жизнь в древнем мире!</h1>
                    <p class="desc">Ласковый шепот прибоя, белый песчаный берег и яркое солнце!
                        На маленьком острове где-то в Средиземноморье возникает древняя цивилизация.
                        Под Вашим лидерством начинается эра открытий и процветания.
                        Добро пожаловать в Икариам
                    </p>
                    <div class="joinbutton">
                        <a href="/main/register/" title="Давай! Нажми меня!">Играть бесплатно сейчас!</a>
                    </div>
                    <form id="loginForm" name="loginForm" action="#" method="post">
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
                                        <select id="universe" class="uni" size="1">
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
                    </div>
            </div>
            <div id="footer"></div>
            <div id="footer2">© 2010 by Nexus.</div>
        </div>
    </body>
</html>