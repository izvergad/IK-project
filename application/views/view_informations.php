<?switch($position){?>
<?case 1:?>
<div id="mainview">
    <div class="informations">
        <h1 class="informationsTitel">FAQ - Строительство, стройматериалы и население</h1>
        <h2>Как построить здание?</h2>
        <img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_build_landside.gif">&nbsp;&nbsp;
        <div class="content">Нажмите на свободное место на карте города. Вы увидите список доступных для постройки зданий. При этом имеются два специальных места для постройки в прибрежной полосе (синий флаг) и одно место для городской стены (жёлтый флаг).</div>
        <img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_sawmill_100x81.gif">&nbsp;&nbsp;
        <h2>Как получить стройматериалы?</h2>
        <div class="content">Переключитесь на карту острова и выберите лесопилку. С помощью ползунка Вы можете отправлять граждан на работу на лесопилке.</div>
        <h2>Как получить ресурсы?</h2>
        <div class="content">Вы можете добывать ресурсы (вино, мрамор, хрусталь или сера), как только Вы исследовали Благосостояние (Экономика). Добыча ресурсов осуществляется по тому же принципу, что и добыча строительного материала. Вы можете торговать ресурсами с другими игроками, даже если Вы еще не исследовали Благосостояние.</div>
        <h2>Как увеличить население?</h2>
        <div class="content">Население увеличивается автоматически и при этом тем быстрее, чем выше уровень довольства.</div>
        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left"></td>
                    <td width="50%" align="right">
                        <a title="К теме: FAQ - Транспорт, исследования и войска" href="/game/informations/2/">FAQ - Транспорт, исследования и войска<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 2:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">FAQ - Транспорт, исследования и войска</h1>
        <h2>Как транспортировать ресурсы из одного города в другой?</h2>
        <img src="<?=$this->config->item('style_url')?>skin/img/city/building_port.gif">&nbsp;&nbsp;
        <div class="content">Через карту острова выберите город, в который Вы хотите отправить ресурсы. Затем слева вверху выберите город, из которого будут отправлены ресурсы. Нажмите на "Транспорт товаров" в левом меню.</div>
        <div class="content">Не забудьте, что у Вас должны быть доступные торговые суда. Вы можете приобрести их в порту.</div>
        <h2>Как делать открытия?</h2>
        <img src="<?=$this->config->item('style_url')?>skin/img/city/building_academy.gif">&nbsp;&nbsp;
        <div class="content">Как только Вы построили академию, Вы можете нанять граждан в качестве исследователей. Ваши исследователи будут заниматься новыми открытиями.</div>
        <h2>Почему открытия совершаются так долго?</h2>
        <div class="content">Чем больше исследователей, тем быстрее совершаются открытия. Для этого Вы можете либо улучшить академию, либо построить новые академии  в колониях. Как только Вы исследовали Стекло (Наука), Вы сможете использовать хрусталь для ускорения исследований.</div>
        <h2>Как обучать войска?</h2>
        <img src="<?=$this->config->item('style_url')?>skin/img/city/building_barracks.gif">&nbsp;&nbsp;
        <div class="content">Вам необходимо построить казарму. Здесь Вы можете обучать своих граждан и нанимать войска.</div>
        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: FAQ - Строительство, стройматериалы и население" href="/game/informations/1/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">FAQ - Строительство, стройматериалы и население</a></td>
                    <td width="50%" align="right">
                    <a title="К теме: FAQ - Боевые корабли и бой" href="/game/informations/3/">FAQ - Боевые корабли и бой<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 3:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">FAQ - Боевые корабли и бой</h1>
<h2>Как строить боевые корабли?</h2><img src="<?=$this->config->item('style_url')?>skin/img/city/building_shipyard.gif">&nbsp;&nbsp;<div class="content">Сначала нужно основать верфь, на которой будут строиться военные корабли.</div><h2>Как защитить свой город?</h2><div class="content">Войска, находящиеся в городе в момент нападения, автоматически встанут на его защиту.</div><h2>Могу ли я потерять город?</h2><div class="content">Нет, но возможна его временная оккупация врагом.</div><h2>Как атаковать другой город?</h2><div class="content">Через меню выбора выберите город, в котором размещена Ваша армия. Теперь перейдите на Карту Острова с городом, на который Вы хотите напасть. Нажимая на Вашу жертву, Вы увидите меню слева с выбором грабить или занять.</div><h2>Почему мои войска захватили так мало добычи?</h2><div class="content">У разбитого противника есть большие склады, или у Вас слишком мало доступных торговых судов. Вы можете построить торговые суда в порту. Количество награбленных ресурсов также зависит от размера порта Вашей жертвы.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: FAQ - Транспорт, исследования и войска" href="/game/informations/2/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">FAQ - Транспорт, исследования и войска</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: FAQ - Города и альянсы" href="/game/informations/4/">FAQ - Города и альянсы<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 4:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">FAQ - Города и альянсы</h1>
<h2>Мои граждане недовольны!</h2><div class="content">Вы можете повысить уровень довольства граждан, построив таверну и поставляя большее количество вина. Также можно построить музей и заключить культурные договора.</div><h2>У меня недостаточно золота!</h2><div class="content">Исследователи, войска и военные корабли требуют содержания. Точный обзор Вашего баланса Вы найдете при нажатии на иконку "золото" с левой стороны страницы.</div><img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_finances.gif">&nbsp;&nbsp;<h2>Как создавать новые города?</h2><img src="<?=$this->config->item('style_url')?>skin/img/city/building_palace.gif">&nbsp;&nbsp;<div class="content">Как только Вы исследовали Экспансию, Вы можете построить дворец. Каждая ступень дворца позволит основать новый город. Для этого необходимы 1.250 ед.  стройматериалов, 12.000 ед. золота, 40 граждан для новой колонии, а также 5 доступных торговых судов. Если эти требования выполнены, найдите свободное для постройки место на острове, нажмите на него и основывайте колонию.</div><h2>Как основать альянс?</h2><img src="<?=$this->config->item('style_url')?>skin/img/city/building_embassy.gif">&nbsp;&nbsp;<div class="content">Для этого нужно посольство 3. уровня или выше. В посольстве будет доступна опция создания альянса.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: FAQ - Боевые корабли и бой" href="/game/informations/3/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">FAQ - Боевые корабли и бой</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Первые Шаги - Что такое браузерная игра?" href="/game/informations/5/">Первые Шаги - Что такое браузерная игра?<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break?>
<?case 5:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Первые Шаги - Что такое браузерная игра?</h1>
<div class="content">Ikariam -это онлайн игра, в которую можно играть с помощью браузера. Каждой народностью острова, которую Вы встретите, управляет другой игрок. Т.е. нет никаких компьютерных врагов. Сама игра непрерывна, то есть даже если Вы закрыли браузер, жизнь в Ikariam не останавливается. Ваши исследователи продолжают совершать новые открытия, а рабочие - производить ресурсы.</div><div class="hint">Подсказка: При возвращении в игру после долгого отсутствия Ваши советники сообщат Вам все свежие новости.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: FAQ - Города и альянсы" href="/game/informations/4/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">FAQ - Города и альянсы</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Первые шаги - Ресурсы" href="/game/informations/6/">Первые шаги - Ресурсы<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 6:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Первые шаги - Ресурсы</h1>
<div class="content">Для роста города необходимо иметь достаточное количество строительных материалов. Нажмите на карту острова и выберите лесопилку.</div><img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_sawmill_100x81.gif">&nbsp;&nbsp;<div class="content">С помощью ползунка Вы можете нанять граждан для работы в лесу. Не забывайте подтверждать внесенные изменения!</div><div class="hint">Подсказка: Лесопилка используется всеми городами на острове. Спросите своих соседей, не хотят ли они присоединиться.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Первые Шаги - Что такое браузерная игра?" href="/game/informations/5/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Первые Шаги - Что такое браузерная игра?</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Первые Шаги - Здания" href="/game/informations/7/">Первые Шаги - Здания<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 7:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Первые Шаги - Здания</h1>
<div class="content">Если Вы хотите построить новое здание, откройте карту города и выберите свободное место для постройки. Вы увидите список имеющихся в распоряжении зданий.</div><div class="content">Обратите внимание, что имеются два специальных места для зданий порта и одно специальное место для городской стены.</div><img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_build_landside.gif">&nbsp;&nbsp;<img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_build_seaside.gif">&nbsp;&nbsp;<img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_build_wall.gif">&nbsp;&nbsp;<div class="content">Чтобы использовать здание, просто нажмите на него на городской карте. Вы можете также улучшить здание. Как правило, чем выше уровень здания, тем больше имеется возможностей его использования.</div><div class="content">Для начала рекомендуется построить академию, торговый порт и казарму.</div><div class="hint">Подсказка: типы зданий, которые Вы можете построить, зависят от уровня  исследований.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Первые шаги - Ресурсы" href="/game/informations/6/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Первые шаги - Ресурсы</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Первые Шаги - Исследования" href="/game/informations/8/">Первые Шаги - Исследования<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 8:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Первые Шаги - Исследования</h1>
<img src="<?=$this->config->item('style_url')?>skin/img/city/building_academy.gif">&nbsp;&nbsp;<div class="content">Как только Вы построили академию, Вы можете нанять граждан в качестве исследователей. Это осуществляется тем же способом, как и найм рабочих.</div><div class="content">Вы можете указать ученым область/направление для исследований. Имеются следующие возможности:</div><div class="list">
                <ul>
                                    <li>Мореходство - Новые военные суда и усовершенствования в области мореходства, а также принципы взаимоотношений с колониями и другими народностями.</li>
                                    <li>Экономика - Новые типы зданий и усовершенствования производства ресурсов, так же как финансы</li>
                                    <li>Наука - Новые типы зданий, а также усовершенствования в области исследований</li>
                                    <li>Армия - Новые виды войск и усовершенствования для них</li>
                                </ul>
            </div><div class="hint">Подсказка: Содержание исследователей требует затрат. Если у Вас мало золота, Вы можете отправить их в отпуск.</div><div class="hint">Подсказка: В библиотеке академии  Вы можете любое время просмотреть все открытия в . Даже те, до которых Вы сами еще не дошли!</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Первые Шаги - Здания" href="/game/informations/7/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Первые Шаги - Здания</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Первые шаги - Торговля" href="/game/informations/9/">Первые шаги - Торговля<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 9:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Первые шаги - Торговля</h1>
<img src="<?=$this->config->item('style_url')?>skin/img/city/building_port.gif">&nbsp;&nbsp;<div class="content">После постройки порта Вы можете начать создание собственного торгового флота, чтобы торговать ресурсами с другими игроками. Торговые суда можно купить непосредственно в порту. Они будут автоматически использоваться для транспортировки.</div><div class="content">На карте острова выберите город, в который Вы хотите что-либо отправить. В левом меню нажмите на "Транспорт товаров".</div><div class="content">На следующей странице Вы можете выбрать вид и количество ресурсов, которые хотите отправить.</div><div class="content">Каждая миссия транспортировки товаров стоит Вам одного балла действия. Город изначально имеет 3 балла действий и каждый 4 уровень ратуши добавляет по одному баллу действия. После того как миссия заканчивается, балл действия освобождается.</div><div class="hint">Подсказка: Торговые суда не требуют содержания. Если у Вас имеется достаточно золота, рекомендуется заранее начать расширение торгового флота.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Первые Шаги - Исследования" href="/game/informations/8/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Первые Шаги - Исследования</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Первые шаги - Война" href="/game/informations/10/">Первые шаги - Война<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 10:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Первые шаги - Война</h1>
<img src="<?=$this->config->item('style_url')?>skin/img/city/building_barracks.gif">&nbsp;&nbsp;<div class="content">Для обучения войск Вам необходима казарма, а также верфь для строительства военных судов. В случае нападения размещенные в городе войска защитят город автоматически.</div><div class="content">Если сами Вы хотите напасть на кого-либо, выберите его город на карте острова. У Вас появятся следующие варианты в левом меню карты острова:</div><div class="list">
                <ul>
                                    <li>Разграбление (требует войск) - Ваши войска пытаются разграбить ресурсы этого города.</li>
                                    <li>Занять город (требует войск) - Вы можете использовать занятый город как отправную точку для других кампаний.Часть содержания Ваших солдат идет на войска, расположенные в занятом городе.</li>
                                    <li>Блокировать гавань (требует военных судов) - Вы блокируете любое судоходное движение в заблокированный город и из него.</li>
                                </ul>
            </div><div class="content">Для каждого из трех пунктов действительно следующее: если войска находятся в городе, Вы должны сначала их победить. Если Вы нападаете на кого-то на том же самом острове, Вам не нужно сражаться против военных судов противника. Если Вы нападаете на город на другом острове, Вы должны сначала победить военные суда противника.</div><div class="content">Каждое действие стоит одно очко действия, смотрите предудыщую страницу.</div><div class="hint">Подсказка: Прежде чем совершить набег, удостоверьтесь, что обладаете достаточным количеством свободных торговых судов. Главная задача Ваших солдат - сражаться с врагом, а не разбрасывать силы на транспортировку трофеев.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Первые шаги - Торговля" href="/game/informations/9/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Первые шаги - Торговля</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Защищающая рука богов" href="/game/informations/11/">Защищающая рука богов<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 11:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Защищающая рука богов</h1>
<img src="<?=$this->config->item('style_url')?>skin/img/island/noobschutz.gif">&nbsp;&nbsp;<div class="content">Изначально новые игроки застрахованы от нападений, чтобы им легче было освоить мир Ikariam. В случае если ваша защита будет активирована, на карте острова рядом с вашим городом появится значок белого голубя. </br> Эта защита снимается когда: </br><ul><li>Город будет отстроен до уровня 4 (уровня 6 с активированным Премиум аккаунтом).</li><li>Игрок отправит свои войска на атаку другого игрока.</li><li>Когда ваши корабли прибудут для основания новой колонии.</li></div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Первые шаги - Война" href="/game/informations/10/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Первые шаги - Война</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Навигация" href="/game/informations/12/">Навигация<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 12:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Навигация</h1>
<div class="content">В Ikariam есть три способа обзора. С помощью навигационного меню Вы можете легко изменить вид отображения.</div><div style="width:84px; height:18px;overflow:hidden;margin-bottom:5px;background-image:url(<?=$this->config->item('style_url')?>skin/layout/btn_world.jpg);padding-top:36px;color:#542C0F;font-size:10px;text-align:center;">Мир</div><div class="content">На Карте Мира у Вас есть обзор мира Ikariam. Вы можете передвигать карту при помощи навигационных стрелок в левом меню. Вы получите всю необходимую информацию о каком-либо острове при нажатии на него: количество городов на острове, чудеса света и ресурсы. При повторном нажатии на выбранный остров Вы перейдете на Карту Острова.</div><div style="width:84px; height:18px;overflow:hidden;margin-bottom:5px;background-image:url(<?=$this->config->item('style_url')?>skin/layout/btn_island.jpg);padding-top:36px;color:#542C0F;font-size:10px;text-align:center;">Остров</div><div class="content">Карта Острова покажет Вам все города на острове, а также чудеса и ресурсы этого острова. Вы можете также увидеть обзор всех военных действий. При нажатии на город открывается список всех доступных действий в левом меню, например, Транспорт товаров или Грабеж.</div><div class="hint">Подсказка: Вы можете видеть ресурсы и чудеса только на том острове, на котором у Вас есть город.</div><div class="hint">Подсказка: Когда Вы перейдете на Карту Города, то город, который находится в Вашем списке выбора, будет показан автоматически.</div><div class="hint">Примечание: Информация о военных действиях на острове будет доступна, если у Вас есть колония на этом острове или город союзника.</div><div class="hint">Примечание: Ваши колонии подсвечены синим на острове, города соклан - зеленым. Города, в которых для Вас действует Право Гарнизона будут подсвечены желтым. Все остальные колонии - красным.</div><div style="width:84px; height:18px;overflow:hidden;margin-bottom:5px;background-image:url(<?=$this->config->item('style_url')?>skin/img/informations/scr_gotocity.gif);padding-top:38px;color:#542C0F;font-size:10px;text-align:center;">Город</div><div class="content">Карта города отображает Ваш город. Здесь Вы можете создавать новые здания при нажатии на свободное место. Чтобы войти в здание, нажмите на него.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Защищающая рука богов" href="/game/informations/11/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Защищающая рука богов</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Население и довольство жизнью" href="/game/informations/13/">Население и довольство жизнью<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 13:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Население и довольство жизнью</h1>
<img src="<?=$this->config->item('style_url')?>skin/img/city/building_townhall.gif">&nbsp;&nbsp;<div class="content">Количество населения определяется уровнем Вашей ратуши. Прирост населения зависит от уровня довольства граждан. У Вас есть следующие варианты, чтобы поддерживать граждан в хорошем настроении:</div><img src="<?=$this->config->item('style_url')?>skin/img/city/building_tavern.gif">&nbsp;&nbsp;<div class="content">Таверна дает Вам возможность разливать вино населению. С каждой ступенью улучшения таверны увеличивается количество вина, которое может быть предложено населению. Поданное вино вычитывается ежечасно из ресурсов города.</div><div class="hint">Подсказка: Если Вы планируете покинуть своих граждан на какое-то время, убедитесь, что у Вас достаточно винных запасов. Если вино закончится, бонус довольства через таверну исчезнет.</div><img src="<?=$this->config->item('style_url')?>skin/img/city/building_museum.gif">&nbsp;&nbsp;<div class="content">В музее Вы можете выставлять культурные ценности других народов. Для этого сначала необходимо заключить культурное соглашение с другим игроком. Затем задается количество культурных ценностей для показа. Каждая ступень улучшения музея дает Вам право на одну дальнейшую выставку,что способствует повышению уровня довольства в городе.</div><div class="hint">Подсказка: Если уровень довольства упадет или вовсе достигнет отрицательного значения, граждане начнут покидать Ваш город!</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Навигация" href="/game/informations/12/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Навигация</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Золото и финансы" href="/game/informations/14/">Золото и финансы<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 14:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Золото и финансы</h1>
<img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_finances.gif">&nbsp;&nbsp;<div class="content">Ваш приток золота зависит от занятости населения. Доход исчисляется следующим образом:</div><div class="list">
                <ul>
                                    <li>Каждый гражданин приносит в казну 3 единицы золота в час</li>
                                    <li>Каждый рабочий приносит 0 золота в час</li>
                                    <li>Каждый исследователь тратит из казны 6 единиц золота в час</li>
                                    <li>Войска и военные суда в Вашем городе требуют установленное содержание</li>
                                    <li>Войска и военные суда, находящиеся в пути, требуют двойное содержание</li>
                                </ul>
            </div><div class="content">Ваше благосостояние связано не с одним городом, а  со всей Вашей островной империей.</div><div class="content">Список текущих доходов и  расходов всех Ваших городов можно получить при нажатии на иконку с золотом в верхнем меню слева.</div><div class="content">Если у Вас нет золота (т.е. 0 единиц золота или меньше), то деньги начнут поступать за счет отмененных построек. Затем начнут дезертировать войска или боевые корабли, находящиеся в пути. Те, у кого самое низкое содержание, уйдут первыми. Если этого будет недостаточно для поправления Вашей финансовой ситуации, начнут дезертировать войска или боевые корабли, расположенные в обремененном долгами городе. Если и этого будет мало, Ваши исследователи превратятся в обычных граждан.</div><h2>Логистика и торговля</h2><img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_merchantnavy.gif">&nbsp;&nbsp;<div class="content">Торговые корабли Вы можете приобресьти в торговом порте. Количество занятых сухогрузов, также как и общее их количество, Вы можете посмотреть рядом с иконкой кораблей в левом верхнем углу Вашего экрана. Нажав на эту кнопку Вы сможете посмотреть список перевозок. Как и золото, торговые корабли не привязаны  к какому-то одному Вашему городу, они доступны из любого города и формируют собой единую систему снабжения для Вашей империи.</div><div class="hint">Подсказка: Вместимость торгового корабля до 500 единиц ресурса. Сколько места необходимо для перевозки боевых единиц Вы можете узнать на странице описания войска.</div><h2>Амброзия</h2><img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_premium.gif">&nbsp;&nbsp;<div class="content">Вы можете посмотреть сколько амброзии у Вас осталось рядом с символом амфоры слева, наверху экрана. Если Вы нажмете на знак, то Вы будете переадресованы к информационному экрану, на котором Вы сможете узнать на что Вы можете потратить свою амброзию.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Население и довольство жизнью" href="/game/informations/13/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Население и довольство жизнью</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Ресурсы - Строительный материал" href="/game/informations/15/">Ресурсы - Строительный материал<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 15:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Ресурсы - Строительный материал</h1>
<div class="content">В Ikariam есть два типа ресурсов - строительный материал и добываемые ресурсы. Строительный материал используется в различных целях:</div><div class="list">
                <ul>
                                    <li>Здания и их улучшение</li>
                                    <li>Войска и боевые корабли</li>
                                    <li>Расширение добычи ресурсов</li>
                                    <li>Основание колонии</li>
                                </ul>
            </div><img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_sawmill_100x81.gif">&nbsp;&nbsp;<div class="content">Вы можете попасть на лесопилку через Карту Острова или через ратушу. С помощью передвижного регулятора можно задать число граждан для работы на лесопилке.</div><div class="content">Стадия улучшения лесопилки определяет число рабочих, которые Вы можете отправить на производство стройматериала. Новая стадия улучшения будет достигнута, когда все игроки на острове пожертвовали достаточно стройматериала. Меню пожертвований находится слева на странице лесопилки.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Золото и финансы" href="/game/informations/14/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Золото и финансы</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Ресурсы - Добыча" href="/game/informations/16/">Ресурсы - Добыча<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 16:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Ресурсы - Добыча</h1>
<div class="content">В Ikariam имеются 4 различных типа ресурсов: вино, мрамор, хрусталь и сера. Ресурсы доступны только тогда, когда Вы исследовали Благосостояние (Экономика). Каждый остров обладает только одним источником ресурсов. Каждый ресурс имеет свое собственное применение:</div><div class="list">
                <ul>
                                    <li>Вино - нужно для таверны и кухни.</li>
                                    <li>Мрамор - необходим для более высоких уровней при улучшении большинства зданий.</li>
                                    <li>Хрусталь - нужен для академии, докторов и усовершенствований в мастерской. Может также использоваться для ускорения исследований, если Стекло (Наука) уже исследовано.</li>
                                    <li>Сера - требуется для войск и военных судов (в большинстве случаев).</li>
                                </ul>
            </div><div class="content">Залежи ресурсов Вы найдете через соответствующую иконку на Карте Острова или через ссылку в ратуше. На странице с источником ресурса можно задать с помощью передвижного регулятора число граждан для добычи ресурса.</div><div class="content">Как и на лесопилке, уровень месторождения определяет количество рабочих, которые могут здесь работать. Ресурс разрабатывается всеми игроками острова и улучшается через пожертвования стройматериала. Меню пожертвований находится на левой стороне страницы.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Ресурсы - Строительный материал" href="/game/informations/15/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Ресурсы - Строительный материал</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Искусство войны - Оккупация" href="/game/informations/17/">Искусство войны - Оккупация<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 17:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Искусство войны - Оккупация</h1>
<img src="<?=$this->config->item('style_url')?>skin/actions/occupy.gif">&nbsp;&nbsp;<div class="content">Для оккупации чужого города должны быть выполнены следующие требования:</div><div class="list">
                <ul>
                                    <li>Вы должны провести исследование "Губернатор" из ветки "Милитаризм".</li>
                                    <li>Уровень Вашего дворца должен быть больше, чем количество оккупированных Вами городов.</li>
                                </ul>
            </div><div class="content">Вы можете выбрать миссию <i>Оккупировать Город</i> на любом чужом городе на своем острове или на карте. Эта миссия не ограничена временем, если только Вы не отзовете свою армию или она не будет уничтожена. Также не забывайте, что содержание войск в оккупированном городе будет стоить Вам двойную цену.</div><div class="hint">Информация: Каждый плацдарм и каждый оккупированный город имеет свои собственные пункты действия с минимумом из 1 пунктов действия. Для каждого 4 уровня города вы будете получать один дополнительный пункт действия.</div><img src="<?=$this->config->item('style_url')?>skin/actions/move_army.gif">&nbsp;&nbsp;<div class="content">Члены Вашего альянса и непосредственно Вы сами можете размещать дополнительные войска и корабли в оккупированных Вами городах. С их помощью Вы можете совершать любые военные миссии.</div><div class="content">Вы можете оккупировать города из другого оккупированного Вами города, если удовлетворяются все необходимые требования. Смотрите выше.</div><div class="content">Оккупационные войска не грабят город - они защищают его от попыток остановить оккупацию и от прочих атак.</div><img src="<?=$this->config->item('style_url')?>skin/actions/defend.gif">&nbsp;&nbsp;<div class="content">Оккупированный игрок не может начинать ни каких военных миссий из оккупированного города за исключением начала восстания против оккупационных сил. Он будет получать 10% товаров от грабежей, выполненных оккупантом из этого города. Остальные товары будут перемещаться в основной город оккупанта, а войска, участвующие в набеге, будут оставаться в оккупированном городе.</div><div class="content">В оккупированном городе стоимость войск и кораблей увеличивается на 100%.</div><div class="hint">Подсказка: Если во время выполнения миссии, отправленной из оккупированного города, этот город был освобожден своим владельцем, то по возвращению в него Ваша армия будет потеряна, а награбленные Вами ресурсы полностью перейдут к законному владельцу города. В случае, если Ваши войска вернутся в город с заблокированным портом, то эти ресурсы пойдут в город из которого была выставленна блокада, а Ваша армия пройдет сквозь блокаду и разместится в казармах. Необходимо помнить, что для предотвращения подобных ситуаций оккупант обязан всегда держать оккупированный город и гавань под своим полным контролем.</div><div class="content">Вы можете отзывать свои войска и флоты, размещённые в оккупированных городах в любое время. Вы также все ещё можете выбирать, какой из ваших городов должен являться столицей.</div><div class="hint">Подсказка: Вы можете увидеть оккупированные Вами города в своём дворце. Там же Вы можете прекратить оккупацию. Кроме того, не забывайте, что оккупацию может прекратить владелец оккупированного города путём его освобождения.</div><div class="content">Вы можете также посмотреть свой оккупированный город на странице общего обзора городов.</div><img src="<?=$this->config->item('style_url')?>skin/img/informations/scr_city_is_occupied.jpg">&nbsp;&nbsp;        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Ресурсы - Добыча" href="/game/informations/16/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Ресурсы - Добыча</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Битва" href="/game/informations/18/">Битва<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 18:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Битва</h1>
<div class="contentWithImage" style="display:table"><img style="float:right;" alt ="" src="<?=$this->config->item('style_url')?>skin/research/area_military.jpg">Битва - это суть игры Ikariam. Наиболее важно развивать ощущение боевого процесса, и также учиться оценивать войска противника. В других браузерных стратегических играх, битва заканчивается до того, как начинается стратегия. Обычно два игрока конкурируют друг с другом со своими армиями и затем победитель вычисляется автоматически. Это не относится к Ikariam!</div><div class="content">Битва в Икариам длится несколько `раундов`, между которыми проходит отрезок времени. Первый раунд битвы завершается сразу, как только войска вступают в бой, последующие раунды имеют интервалы в 20 минут, и так продолжается пока одна из сторон не победит. В течении этого времени обе стороны могут отправлять войска для поддержки, призывать союзников на свою сторону или уводить войска из битвы.</div><div class="content">Если игрок находится в невыгодном для себя положении в первом раунде, он еще может решить все, прислав подмогу. Если у одной из сторон заканчиваются боеприпасы в пятом раунде, то она может прислать аммуницию и боеприпасы. Если новые боеприпасы не прибывают, сражение проиграно. Игроки могут даже изменить стороны сражения в течение битвы и поменяться местами. Нет ничего невозможного!</div><div class="content">В этой части (вы можете выбрать подразделы в левой части меню!) вы можете узнать о правилах по которым рассчитываются потери обоих сторон в течении битвы. Прочитайте эти правила, чтобы узнать о значении отдельных подразделений для вашей армии.</div><div class="content">Сделайте битву проще: Нет ничего случайного из того, что происходит во время сражения. Игрок с правильным боевым порядком армии выигрывает битву.</div><div class="content">Никогда не забывайте: Все что случается за между раундами - может повлиять на победу в сражении!</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Искусство войны - Оккупация" href="/game/informations/17/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Искусство войны - Оккупация</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Подразделения" href="/game/informations/19/">Подразделения<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 19:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Подразделения</h1>
<h2>Подразделения</h2><div class="content">Боевые единицы в Икариам делятся на <b>боевые классы</b>. Класс юнита может рассказать о том, как нужно использовать данную единицу.</div><div class="listHeaderContentImage">
                <ul>
                                    <li><div style="display:table"><h2>тяжелая пехота</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/phalanx_r_120x100.gif"><b>Большая часть вашей армии</b> должна состоять из профессиональной тяжелой пехоты. Главной задачей этих подразделений является <b>сдержать врага в течении битвы</b> и непозволить врагу прорвать линию фронта. Если вы не знаете что строить - стройте тяжелую пехоту! Если у вас нет тяжелой пехоты на поле боя, другим подразделениям придется выполнять ее работу, что сильно осложняет ваши шансы на успех в бою.</p></div></li>
                                    <li><div style="display:table"><h2>легкая пехота</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/swordsman_r_120x100.gif">Легкая пехота состоит из легковооруженных, мобильных бойцов ближнего боя, которые защищают ваших воинов на <b>на флангах</b> и пытаются <b>прорваться</b> к врагу. Если их не сможет перехватить легкая пехота врага, они смогут атаковать вражескую <b>дистанционную пехоту</b>.</p></div></li>
                                    <li><div style="display:table"><h2>Дистанционная Пехота</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/archer_r_120x100.gif">Дистанционные бойцы ослабляют и замедляют вражескую <b>тяжелую пехоту</b> и собственной тяжелой пехоте легче прорваться сквозь врагов в бою. Дистанционные бойцы очень полезны при обороне, так как они могут стрелять из-за стен. Обычно дистанционные бойцы наносят <b>травмы</b>, котоорые снижают вражескую выносливость и которые могут быть восстановлены только докторами. Самое худшее, что может произойти с дистанционными бойцами - это столкновение с легкой или тяжелой пехотой врага - поэтому хорошо защищайте их !</p></div></li>
                                    <li><div style="display:table"><h2>Артиллерия</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/catapult_r_120x100.gif">Артиллерийские подразделения осуществляют снос вражеских <b>городских стен</b>. Они наносят огромный урон. Их стоимость очень <b>высока</b> и соизмерима с ущербом, который они наносят. Если артиллерия промахивается по стенам, она попадает по вражеским тяжелым подразделениям. Эти повреждения обычно не дают шансов для выживания, однако это также означает, что большая часть урона, который способна наносить артиллерия, остается неиспользованным, поэтому командующий должен рассудить верно о балансе наносимого урона и стоимости артиллерии.</p></div></li>
                                    <li><div style="display:table"><h2>Пилот Истребителя (Авиация)</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/gyrocopter_r_120x100.gif">Пилоты истребителей входящие в состав <b>авиации</b>, специализируются на уничтожении других <b>летательных аппаратов</b>. Они не могут атаковать наземные подразделения и не поднимаются в воздух, если у противника нет летательных аппаратов. Пилоты истребителей могут вступать в бой только там, где присутствуют вражеские пилоты и/или если требуется расчистить воздух для прохода собственных бомбардировщиков.</p></div></li>
                                    <li><div style="display:table"><h2>Бомбардировщик (Авиация)</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/bombardier_r_120x100.gif">Бомбардировщики являются частью <b>авиации</b> и их основная обязанность атаковать <b>вражеские наземные подразделения</b> с воздуха. Основным приоритетом здесь является <b>артиллерия</b>. Таким образом они могут остановить оккупационные войска до того, как атакующий нанесет серьезный ущерб стенам города. Бомбардировщики не следует недооценивать, когда идет битва против обычных наземных подразделений. Однако, по сравнению с артиллерией, они очень дорого стоят. Если вы хотите использовать бомбардировщики, следует учитывать, что против вражеских пилотов истребителей, у бомбардировщиков нет никаких шансов в бою.</p></div></li>
                                    <li><div style="display:table"><h2>Поддержка</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/medic_r_120x100.gif">Вспомогательные подразделения объединяет то, что они могут значительно повлиять на ход битвы, не сражаясь между собой. Доктора и повара входят в эту категорию войск. Функции этих подразделений различны и отличаются в зависимости от ситуации, поэтому внимательно читайте их описание перед использованием.</p></div></li>
                                </ul>
            </div><div class="content">Представляем основные классы единиц. Выслушайте внимательно (Внимание: Только для опытных игроков!): В ходе игры вы можете встретить подразделения, которые принадлежат <b>более, чем к одному классу</b>! Первый класс называется <b>первый класс</b>, второй вторым и так далее. Например: летчик-истребитель/бомбардировщик имеют класс воздушного боя и также, класс сухопутной атаки. Для летчика-бомбардировщика более приоритетным является класс сухопутной атаки, так как у него нет принадлежности к воздушной атаке. Возможны многочисленные комбинации. Пехота дальней дистанции / легкая пехота комбинирует в сражении свое оснащение и пытается обойти для атаки с флангов.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Битва" href="/game/informations/18/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Битва</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Урон & Потери" href="/game/informations/20/">Урон & Потери<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 20:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Урон & Потери</h1>
<div class="content">Каждое подразделение, принимающее участие в сражении, имеет <b>`Здоровье`</b> (или другими словами - некое число жизненных пунктов). Если боец получает <b>повреждение</b>,  его здоровье уменьшается. Если здоровье становится равным 0, боец погибает. Чтобы защититься от повреждений, некоторые бойцы используют броню.</div><div class="content"><b>Сила брони</b> вычитается непосредственно из урона. Это означает, что если боец с броней равной 3, получает атаку силой 5, его урон здоровья составит 5-3=2. Если броня выше урона, атака <b>бесполезна</b>! Броня особенно эффективна в боях, когда действует множество мелких атак с маленьким уроном. Броня не приносит особой пользы, когда атаки крупные и наносят большой урон. Самым лучшим вариантом является оснащение броней тяжелой пехоты. Тогда противостояние против дистанционных подразделений становится особенно эффективным.</div><div class="content">В случае, если бойцы были лишь <b>ранены</b>, но из-за отсутствия <b>лечащих подразделений</b> их силы не были восстановлены, после битвы их здоровье будет полностью восстановлено. Чтобы нанести непоправимый урон - необходимо сосредоточить огонь на нескольких подразделениях, чтобы полностью их уничтожить. На этот фактор влияет `Точность` оружия.</div><div class="content">Виды <b>оружия</b>? Да, большинство подразделений оснащены разными видами оружия! Повреждения, наносимые подразделением, зависят от <b>кучности</b> и <b>точности</b> используемого оружия. На самом деле здесь нет ничего сложного: В зависимости от позиции на поле боя, используется разное оружие. Лучники вооружены луками и короткими мечами для защиты. Они будут использовать луки, пока враги не приблизятся на расстояние удара или пока не закончатся боеприпасы. Луки, как и большинство других дистанционных вооружений, не слишком точны и имеют большой разброс. Поэтому, луки распределяют урон по большой площади и по всем типам врагов. Это оружие считается низким по концентрации и точности, что означает большое количество раненых солдат, но малое количество убитых. Если фронт прорвется и тяжелая пехота проникнет к лучникам, те вытащат короткие мечи и вступят в бой. Оружие ближнего боя обычно является очень точным, но имеет малую площадь обработки. Наносимый урон обычно концентрируется на линии фронта, где происходят основные стычки, при этом есть шанс, что свои воины получат удар сзади. Однако это не означает рост числа погибших, хотя число травм уменьшается.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Битва" href="/game/informations/19/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Битва</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Лечение" href="/game/informations/21/">Лечение<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 21:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Лечение</h1>
<div class="content">Как уже отмечалось в главе `урон & потери`, некоторые войска, например, доктора, могут <b>восстанавливать здоровье</b>. Это действует только на те подразделения, которые потеряли часть жизненных пунктов. Павшие войска не могут быть восстановлены. Лечащие подразделения имеют <b>навык лечения</b>, т.е. максимальное количество пунктов, которые они могут восстановить за сражение; это связано с <b>ограниченным перевязочным материалом</b>. Когда запасы закончатся, лечение будет прекращено.</div><div class="content">Еще более сложным является тот момент, что лечащие подразделения не могут восстановить жизнь у всех войск!  Каждый боец принадлежит к определенному <b>типу войск</b>, который определяет: является ли боец <b>человеком или он машина</b>. Поэтому доктор не сможет отремонтировать таран! Используйте лечащие подразделения с умом, когда в армии есть механические подразделения.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Урон & Потери" href="/game/informations/20/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Урон & Потери</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Поле битвы" href="/game/informations/22/">Поле битвы<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 22:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Поле битвы</h1>
<div class="content">Настало время, взглянуть на общую картину! Кто чем сражается, каким оружием и как находится на поле боя. <b>Базовая структура</b> сухопутного сражения включает в себя:</div><div class="content"><div id="bf_open">
													    <div class="side defender">
													      <div class="textLabel">Защитник</div>
													      <div class="location hkl">
													        <div class="textLabel">Линия Фронта</div>

													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													        <div class="slot slot4">30</div>
													        <div class="slot slot5">30</div>
													        <div class="slot slot6">30</div>

													        <div class="slot slot7">30</div>
													      </div>
													      <div class="location flank1">
													        <div class="textLabel">Фланг</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													      </div>

													      <div class="location flank2">
													        <div class="textLabel">Фланг</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													      </div>
													      <div class="location fkl">
													        <div class="textLabel">Боевая линия дистанционных подразделений</div>

													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													        <div class="slot slot4">30</div>
													        <div class="slot slot5">30</div>
													        <div class="slot slot6">30</div>

													        <div class="slot slot7">30</div>
													      </div>
													      <div class="location arty">
													        <div class="textLabel">Артиллерия</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>

													      </div>
													      <div class="location air">
													        <div class="textLabel">Воздух</div>
													        <div class="slot slot1">30</div>
													      </div>
													    </div>
													    <div class="side attacker">
													      <div class="textLabel">Атакующий</div>

													      <div class="location hkl">
													        <div class="textLabel">Линия Фронта</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													        <div class="slot slot4">30</div>

													        <div class="slot slot5">30</div>
													        <div class="slot slot6">30</div>
													        <div class="slot slot7">30</div>
													      </div>
													      <div class="location flank1">
													        <div class="textLabel">Фланг</div>
													        <div class="slot slot1">30</div>

													        <div class="slot slot2">30</div>
													      </div>
													      <div class="location flank2">
													        <div class="textLabel">Фланг</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													      </div>

													      <div class="location fkl">
													        <div class="textLabel">Боевая линия дистанционных подразделений</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													        <div class="slot slot4">30</div>

													        <div class="slot slot5">30</div>
													        <div class="slot slot6">30</div>
													        <div class="slot slot7">30</div>
													      </div>
													      <div class="location arty">
													        <div class="textLabel">Артиллерия</div>
													        <div class="slot slot1">30</div>

													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													      </div>
													      <div class="location air">
													        <div class="textLabel">Воздух</div>
													        <div class="slot slot1">30</div>
													      </div>

													    </div>
													  </div>
                                    </div><div class="content">Как вы видите, существуют различные `зоны` или <b>боевые линии</b>. <b>Главная боевая линия</b> находится в центре, перед ней находится линия <b>дальней атаки</b>, <b>фланги</b> со сторон и <b>артиллерия</b> позади. Каждый отсек содержит <b>область</b> линий. Ваши войска поделены на группы, которые заполняют каждую секцию. Тем не менее, только один тип войск может занимать секцию (командир пращников не способен отдавать команды командиру стрелков). Наиболее важной линией является основная линия сражения. Другие зоны будут заняты теми единицами войск, которые способны нанести урон, но необходимо, чтобы <b>все воины пытались сохранить боевой порядок</b>. Это означает, что подразделения легкой пехоты, дистанционной пехоты и даже доктора и повара могут двигаться к линии и занимать ее, если нет тяжелой пехоты. Если вы потеряете эту линию, ваши враги сломают боевой порядок. <br\> <b>Исключением</b> здесь являются <b>воздушные юниты и артиллерия</b>. Пилоты и юниты не способные сражаться в первом ряду - бегут с поля боя, если им требуется занять боевую линию.</div><div class="content">Секции имеют ограниченное <b>пространство</b> (обычно 30 мест). Некоторые юниты требуют больше места, чем остальные. Паровые гиганты используют гораздо больше места в области, чем один гоплит. Таким образом количество юнитов, способных нанести ущерб на поле боя, ограничено. Чем больше секций различного типа вы задействуете, тем больший урон нанесет ваша армия за один раунд. Излишки армии занимают секцию <b>резерва</b>, где они дожидаются их очереди вступления в битву за пределами поля боя. В частности, вы должны убедиться, что у вас достаточно резервных сил для основного боя, что вы можете завершить битву без других юнитов, двигающихся к основной линии сражения.</div><div class="content">Большинство сражений в Икарим проходят за конкретный город. Существует множество различных игровых ситуаций, в зависимости от размера города, доступных зданий и числа защитников. </br> Каждый город имеет <b>`ограничение гарнизона`</b> - эта возможность определяет число подразделений, которые могут принимать участие в битве за город. В конце концов не целесообразно возводить стену вокруг города и всех его прилегающих территорий, если юниты, сражающиеся за город - не могут все поместиться в бою. Важными факторами ограничения гарнизона являются <b>размер города и уровень стены</b>. Если лимит гарнизона будет превышен, защитники города <b>сделают вылазку</b> и проведут битву в <b>открытом поле</b>. (Показано на рисунке выше!)</div><div class="content">Как только размер армии снизится до размеров лимита гарнизона, защитники возвращаются в город. Размер поля сражения зависит от размера города. Бывает три типа сражения:</div><h2>Деревня</h2><div class="content">Деревенские поля сражений слишком малы - битвы за города с уровнем до 5-го - проходят на таких же полях. Стоит отметить, что это сражение не имеет флангов, деревни просто очень малы для таких маневров.</div><div class="content"><div id="bf_citysmall">
													    <div class="side defender">
													      <div class="textLabel">Защитник</div>
													      <div class="location hkl">
													        <div class="textLabel">Линия Фронта</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													      </div>
													      <div class="location fkl">
													        <div class="textLabel">Боевая линия дистанционных подразделений</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													      </div>
													      <div class="location arty">
													        <div class="textLabel">Артиллерия</div>
													        <div class="slot slot1">30</div>
													      </div>
													      <div class="location air">
													        <div class="textLabel">Воздух</div>
													        <div class="slot slot1">30</div>
													      </div>
													    </div>
													    <div class="side attacker">
													      <div class="textLabel">Атакующий</div>
													      <div class="location hkl">
													        <div class="textLabel">Линия Фронта</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													      </div>
													      <div class="location fkl">
													        <div class="textLabel">Боевая линия дистанционных подразделений</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													      </div>
													      <div class="location arty">
													        <div class="textLabel">Артиллерия</div>
													        <div class="slot slot1">30</div>
													      </div>
													      <div class="location air">
													        <div class="textLabel">Воздух</div>
													        <div class="slot slot1">30</div>
													      </div>
													    </div>
                                    </div><h2>Город</h2><div class="content">Населенные пункты с уровнями от 5 до 10-го являются частью боевой системы городов. Для их обороны требуется больше юнитов, и фланги тоже должны быть прикрыты.</div><div class="content">  <div id="bf_citymedium">
														    <div class="side defender">
														      <div class="textLabel">Защитник</div>
														      <div class="location hkl">
														        <div class="textLabel">Линия Фронта</div>
														        <div class="slot slot1">30</div>
														        <div class="slot slot2">30</div>
														        <div class="slot slot3">30</div>
														        <div class="slot slot4">30</div>
														        <div class="slot slot5">30</div>
														      </div>
														      <div class="location flank1">
														        <div class="textLabel">Фланг</div>
														        <div class="slot slot1">30</div>
														      </div>
														      <div class="location flank2">
														        <div class="textLabel">Фланг</div>
														        <div class="slot slot1">30</div>
														      </div>
														      <div class="location fkl">
														        <div class="textLabel">Боевая линия дистанционных подразделений</div>
														        <div class="slot slot1">30</div>
														        <div class="slot slot2">30</div>
														        <div class="slot slot3">30</div>
														        <div class="slot slot4">30</div>
														        <div class="slot slot5">30</div>
														      </div>

														      <div class="location arty">
														        <div class="textLabel">Артиллерия</div>
														        <div class="slot slot1">30</div>
														        <div class="slot slot2">30</div>
														      </div>
														      <div class="location air">
														        <div class="textLabel">Воздух</div>
														        <div class="slot slot1">30</div>
														      </div>
														    </div>
														    <div class="side attacker">
														      <div class="textLabel">Атакующий</div>
														      <div class="location hkl">
														        <div class="textLabel">Линия Фронта</div>
														        <div class="slot slot1">30</div>
														        <div class="slot slot2">30</div>
														        <div class="slot slot3">30</div>
														        <div class="slot slot4">30</div>
														        <div class="slot slot5">30</div>
														      </div>
														      <div class="location flank1">
														        <div class="textLabel">Фланг</div>
														        <div class="slot slot1">30</div>
														      </div>
														      <div class="location flank2">
														        <div class="textLabel">Фланг</div>
														        <div class="slot slot1">30</div>
														      </div>
														      <div class="location fkl">
														        <div class="textLabel">Боевая линия дистанционных подразделений</div>
														        <div class="slot slot1">30</div>
														        <div class="slot slot2">30</div>
														        <div class="slot slot3">30</div>
														        <div class="slot slot4">30</div>
														        <div class="slot slot5">30</div>
														      </div>
														      <div class="location arty">
														        <div class="textLabel">Артиллерия</div>
														        <div class="slot slot1">30</div>
														        <div class="slot slot2">30</div>
														      </div>
														      <div class="location air">
														        <div class="textLabel">Воздух</div>
														        <div class="slot slot1">30</div>
														      </div>
														    </div>
														  </div>
                                    </div><h2>Мегаполис</h2><div class="content">Начиная с уровня 10, поле сражения становится больше. Это также касается открытого поля.</div><div class="content"><div id="bf_citylarge">
													    <div class="side defender">
													      <div class="textLabel">Защитник</div>
													      <div class="location hkl">
													        <div class="textLabel">Линия Фронта</div>
													        <div class="slot slot1">30</div>

													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													        <div class="slot slot4">30</div>
													        <div class="slot slot5">30</div>
													        <div class="slot slot6">30</div>
													        <div class="slot slot7">30</div>

													      </div>
													      <div class="location flank1">
													        <div class="textLabel">Фланг</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													      </div>
													      <div class="location flank2">

													        <div class="textLabel">Фланг</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													      </div>
													      <div class="location fkl">
													        <div class="textLabel">Боевая линия дистанционных подразделений</div>
													        <div class="slot slot1">30</div>

													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													        <div class="slot slot4">30</div>
													        <div class="slot slot5">30</div>
													        <div class="slot slot6">30</div>
													        <div class="slot slot7">30</div>

													      </div>
													      <div class="location arty">
													        <div class="textLabel">Артиллерия</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													      </div>

													      <div class="location air">
													        <div class="textLabel">Воздух</div>
													        <div class="slot slot1">30</div>
													      </div>
													    </div>
													    <div class="side attacker">
													      <div class="textLabel">Атакующий</div>

													      <div class="location hkl">
													        <div class="textLabel">Линия Фронта</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													        <div class="slot slot4">30</div>

													        <div class="slot slot5">30</div>
													        <div class="slot slot6">30</div>
													        <div class="slot slot7">30</div>
													      </div>
													      <div class="location flank1">
													        <div class="textLabel">Фланг</div>
													        <div class="slot slot1">30</div>

													        <div class="slot slot2">30</div>
													      </div>
													      <div class="location flank2">
													        <div class="textLabel">Фланг</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													      </div>

													      <div class="location fkl">
													        <div class="textLabel">Боевая линия дистанционных подразделений</div>
													        <div class="slot slot1">30</div>
													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													        <div class="slot slot4">30</div>

													        <div class="slot slot5">30</div>
													        <div class="slot slot6">30</div>
													        <div class="slot slot7">30</div>
													      </div>
													      <div class="location arty">
													        <div class="textLabel">Артиллерия</div>
													        <div class="slot slot1">30</div>

													        <div class="slot slot2">30</div>
													        <div class="slot slot3">30</div>
													      </div>
													      <div class="location air">
													        <div class="textLabel">Воздух</div>
													        <div class="slot slot1">30</div>
													      </div>

													    </div>
													  </div>
												</div>
                                    </div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Лечение" href="/game/informations/21/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Лечение</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Стены" href="/game/informations/23/">Стены<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 23:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Стены</h1>
<div class="content">Когда построенная <b>городская стена</b> появится на экране города. <b>Юнит стена</b> будет размещен на линии фронта. Каждый юнит блокирует свою секцию. Если все секции заняты, <b>невозможно атаковать с флангов</b>, пока стоит городская стена! Оборонительные подразделения с сильной броней, здоровьем, <b>приспосабливаются к уровню вашей стены</b>! Атакующий будет пытаться уничтожить стену - артиллерия может быть наиболее эффективной. Если управление боем будет невозможно, мораль армии будет сильно падать и юниты быстро сдадутся.</div><div class="content">Как только атакующий уничтожает часть стены (<b>разрушает</b>), защитные единицы сражающихся войск передвигаются вперед, закрывая брешь снова. Если атакующий уничтожает все участки стены, он вскрывает защиту и атакующие единицы передвигаются с флангов для атаки.</div><div class="content">Чем меньше поле боя и чем выше стена, тем больше времени потребуется вашим воинам, чтобы преодолеть защиту. Желательно стремиться к <b>крупным и незащищенным целям</b>. Не существует смысла нападать на маленькие города большой армией, так как придется потратить много времени на осаду, не имея возможности разместить все свои войска в бою, и придется потратить несколько часов пока не наступит победа!</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Поле битвы" href="/game/informations/22/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Поле битвы</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Мораль" href="/game/informations/24/">Мораль<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 24:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Мораль</h1>
<div class="content">В конце концов не самые высокие стены решают ход битвы, а воины, которые столкнувшись с врагом, показывают все свое мужество! Каждая армия входит в бой с хорошей моралью и стойкостью. Это быстро меняется, когда в течении битвы, бойцы начинают <b>бежать с поля боя</b>. Следующие аспекты понижают мораль и стойкость ваших солдат:</div><div class="list">
                <ul>
                                    <li>Получение большего урона, чем противник</li>
                                    <li>Гибель большего числа подразделений, чем у противника</li>
                                    <li>Борьба с городской стеной</li>
                                    <li>Борьба с превосходящими силами противника</li>
                                    <li>Борьба с превосходящими силами противника</li>
                                    <li>Будучи атакованными с флангов.</li>
                                    <li>При продлении битвы еще на раунд.</li>
                                </ul>
            </div><div class="content">Тем не менее, подразделения поддержки, оказывают всяческие действия, противостоя снижению морали и стойкости. Как? Оставляют войска на ночлег, размещая их в лагере. Отправляют в бой поваров, которые снабжают войска сытным обедом и организуют праздники между битвами. Это позволяет наполнить солдат удвоенной энергией. Каждый повар способен восстановить мораль, упавших духом солдат.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Стены" href="/game/informations/23/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Стены</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Подразделы" href="/game/informations/25/">Подразделы<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 25:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Подразделы</h1>
<div class="listHeaderContent">
                <ul>
                    <li><h2>Сдерживание линии фронта!</h2><p>Всегда проверяйте, что у вас есть достаточно <b>тяжелой пехоты</b> для защиты вашей армии. Без тяжелой пехоты другие, менее пригодные подразделения могут заполнить эту нишу. Им придется столкнуться лицом к лицу со своими противниками ближнего боя, и они вряд ли смогут показать здесь весь свой потенциал. Таким образом все ваше боевое построение может рухнуть всего за несколько раундов!</p></li>
                </ul>
            </div><div class="listHeaderSubList">
                <ul>
                    <li><h2>Нанесение наибольшего ущерба за раунд</h2>
                    <ul>                    	<li><p>Тяжелая пехота может быть сильным и легко окупаемым классом бойцов, но если вы сможете сделать <b>больше атак за один раунд</b>, ваш противник не сможет бороться против вас и вы сможете победить. Когда вы вступаете в битву, используйте различные варианты боевых классов и повышайте численность бойцов в них на поле боя.</p></li>
                                            	<li><p>Используйте оружие с высокой концентрацией урона, когда ваш противник использует докторов. Чем больше ваш противник будет лечить своих солдат, тем больший урон вы должны нанести.</p></li>
                                            </ul>
                    </li>
                </ul>
            </div><div class="listHeaderContent">
                <ul>
                    <li><h2>Мораль и ее роль в сражении</h2><p>Если вы сталкиваетесь с мощной армией врага и не можете преодолеть ее сопротивление, попытайтесь ослабить мораль противника. Позовите своих союзников на помощь, чем больше армий будет вступать в битву на вашей стороне, тем больше вражеских солдат будет терять мораль и начнет сомневаться. <b>Совместная битва рисует картину единого фронта и противостояния</b>. Если вы будете действовать совместно на вашем острове, вы сможете победить даже самых мощных захватчиков.</p></li>
                </ul>
            </div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Мораль" href="/game/informations/24/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Мораль</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Морские сражения" href="/game/informations/26/">Морские сражения<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 26:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Морские сражения</h1>
<div class="content">Особенности мореплавания очень похожи на аналогичные сухопутные передвижения. Все юниты имеют уникальные значения и функции. Читайте статьи о <b>сухопутных сражениях</b>, чтобы узнать об этом больше!</div><div class="content">На море также есть линия фронта. Быстрые корабли могут обогнуть оппонентов с флангов - Корабли с дистанционным оружием стреляют на передний фланг с тыла.</div><div class="content">На море нет <b>стен</b> или других фортификационных сооружений такого типа, поэтому <b>артиллерийские корабли</b> не доступны.</div><div class="content">Кроме этого, подводные лодки <b>могут атаковать другие подводные лодки</b>. Обычные корабли не могут противостоять им. Тем не менее, подводные лодки не могут выиграть битвы в одиночку, так как не могут остановить корабли, находясь под водой. При поднятии на поверхность им приходится противостоять боевым кораблям, которые представляют серьезную опасность для них.</div><div class="content">Если все это кажется вам слишком сложным, вам <b>не стоит волноваться</b> - подводные лодки появляются после длительных исследований <b>в конце игры</b>.</div><div class="content">Вы не должны волноваться о своих транспортных кораблях. Они не принимают участия в битве. Если вы проиграете сражение, они <b> вернутся</b> домой через несколько часов.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Подразделы" href="/game/informations/25/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Подразделы</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Искусство войны" href="/game/informations/27/">Искусство войны<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 27:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Искусство войны</h1>
<div class="contentWithImage" style="display:table"><img style="float:right;" alt ="" src="<?=$this->config->item('style_url')?>skin/research/area_military.jpg">В Ikariam есть два различных типа сражений: Морские, где военные корабли борются друг против друга, сухопутные, где идет сражение наземных войск, экипированных военным оборудованием.</div><h2>Божественная защита.</h2><div class="content">Для облегчения игры, новые игроки в мире Икариам не могут быть атакованы. Вы можете увидеть, что защита активирована возле имени города на карте острова.</div><div class="content">Защита заканчивается когда: <br/><ul><li>Ратуша улучшается до уровня 4. (уровня 6 при активации премиум-аккаунта)</li><li>Игрок отправляет войска на атаку другого игрока.</li><li>Основывается первая колония (В момент прибытия кораблей) </li><li> Игрок становится не активным.</li></ul></div><h2>Сценарии</h2><div class="content">Вообще, сражение может начаться одним из двух способов: Первый - атака через город игрока (находящийся на этом же острове), и второй - через морское проникновение (когда цель находится на другом острове).</div><div class="content">Атаки, выполненные сквозь чужие города, приводят к сражениям между атакующим и размещенными солдатами и/или военной аммуницией в этих городах.</div><div class="content">Перед атакой через морское проникновение, необходимо удостовериться, что у противника нет флота в гавани для обороны. Если дело обстоит так, то ваши торговые суда могут быть перехвачены солдатами и в худшем варианте развития событий, они могут быть рассеяны.</div><div class="content">Как только атакуемый город лишается средств обороны, ваши войска могут проникнуть туда и бороться против других сухопутных подразделений.</div><h2>После выбора города-цели на карте острова, вы можете предпринять следующие разновидности действий:</h2><div class="list">
                <ul>
                                    <li>Разбой: Как только все защитники будут побеждены, все ресурсы, не защищенные от разграбления, будут украдены (см. Здания: Склад). Каждое из ваших торговых судов в минуту может загрузить 15 единиц ресурсов. Если ресурсы не будут доступны, или емкость судов будет исчерпана, флот направляется домой.</li>
                                    <li>Блок порта: Ваши боевые корабли предотвращают возможность достижения транспортов до заблокированного города, а также выход транспортов из города.</li>
                                    <li>Оккупируя город (требуется исследование губернатор в секции милитаризм) вы можете использовать его в качестве базы для своих войск.</li>
                                </ul>
            </div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Морские сражения" href="/game/informations/26/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Морские сражения</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Типы подразделений" href="/game/informations/28/">Типы подразделений<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 28:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Типы подразделений</h1>
<h2>Сражение -<i>Типы подразделений:</i></h2><div class="content">В Икариам, боевые подразделения делятся на несколько типов. Каждое из подразделений выполняет свою работу на поле боя.</div><div class="listHeaderContentImage">
                <ul>
                                    <li><div style="display:table"><h2>Тяжелая пехота</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/phalanx_r_120x100.gif">Тяжелая пехота это основа любой армии. Во время рукопашного боя она нападает на противостоящие подразделения, находящиеся в зоне видимости или выступает против атакующиз, чтобы защитить подразделения дистанционного действия и артиллерию позади себя.</p></div></li>
                                    <li><div style="display:table"><h2>Легкая пехота</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/swordsman_r_120x100.gif">Легкая пехота состоит из бойцов рукопашного боя, простая броня которых позволяет им оставаться мобильными. Они поддерживают фланги в сражении, но могут также выручить в линии рукопашного боя, если сил тяжелой пехоты недостаточно.</p></div></li>
                                    <li><div style="display:table"><h2>Бойцы дистанционного взаимодействия</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/archer_r_120x100.gif">Подразделения дистанционного действия формируются позади линии рукопашного боя. Они удерживают вражескую пехоту на безопасном расстоянии, сокращая количество врагов, когда те еще находятся на расстоянии.</p></div></li>
                                    <li><div style="display:table"><h2>Артиллерия</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/catapult_r_120x100.gif">Артиллерия атакует стены в первую очередь. Если те уже разрушены, то артиллерия начинает стрелять по вражеским подразделениям ближнего боя, вызывая невероятные повреждения.</p></div></li>
                                    <li><div style="display:table"><h2>Бомбардировщик</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/bombardier_r_120x100.gif">Работа бомбардировщиков состоит в том, чтобы полностью разрушить противостоящую артиллерию прежде, чем она начнет действовать. Если артиллерия уничтожена или ее не было на поле боя, бомбардировщики наносят удар по линии дальнего действия, затем по линии рукопашного боя и наконец по флангам.</p></div></li>
                                    <li><div style="display:table"><h2>Противовоздушная оборона</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/gyrocopter_r_120x100.gif">У подразделений противовоздушной обороны есть способность перехватить бомбардировщиков прежде, чем они достигнут своих целей. Эта возможность обеспечивает защиту от слишком сильных повреждений. Если в воздухе не были обнаружены дружественные бомбардировщики, противовоздушная оборона противника подвергается нападению. Против других целей эти подразделения не сражаются.</p></div></li>
                                    <li><div style="display:table"><h2>Поддержка</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/medic_r_120x100.gif">Резервные войска состоят из тех подразделений, которые не приняли участия в текущей битве сейчас, но готовы помочь армии в нескольких случаях. Поддержка, которую они оказывают, для каждого подразделения индивидуальна и о ней можно прочитать в описании подразделения.</p></div></li>
                                    <li><div style="display:table"><h2>Стена</h2><p><img align="right" alt ="" src="<?=$this->config->item('style_url')?>skin/characters/military/120x100/wall_r_120x100.gif">Стена занимает линию ближнего боя, когда идет оборона города. Крепость стены, а также мощность вооружения зависит от ее уровня (см. Здания: Город). В большинстве случаев через стену может стрелять только артиллерия. Если стоит хотя бы одна часть стены, нападение с флангов на город невозможно <br/>, Как только нападавший разрушает часть стены (`брешь` в  стене) пордразделения обороны продвигаются в этот промежуток, чтобы закрыть ее. Если атакующий сможет разрушить всю стену, то в бой вступают фланги. Когда сражение заканчивается, стена полностью восстанавливается.</p></div></li>
                                </ul>
            </div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Искусство войны" href="/game/informations/27/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Искусство войны</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Поле битвы" href="/game/informations/29/">Поле битвы<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 29:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Поле битвы</h1>
<img src="<?=$this->config->item('style_url')?>skin/ikipedia/openbattle.gif">&nbsp;&nbsp;<div class="listHeaderSubList">
                <ul>
                    <li><h2>1: Войска поддержки</h2>
                    <ul>                    	<li><p>Может содержать только подразделения `поддержки`.</p></li>
                                            	<li><p>Может содержать неограниченное количество подразделений.</p></li>
                                            	<li><p>Войска поддержки не принимают участия в боевых действиях.</p></li>
                                            </ul>
                    </li>
                </ul>
            </div><div class="listHeaderSubList">
                <ul>
                    <li><h2>2: Бомбардировщики</h2>
                    <ul>                    	<li><p>Может содержать только подразделения типа "бомбардировщик".</p></li>
                                            	<li><p>Подразделения с самым мощным оружием размещаются первыми.</p></li>
                                            	<li><p>Последовательность атаки: Артиллерия, подразделения дистанционного взаимодействия, подразделения ближнего боя, фланги.</p></li>
                                            </ul>
                    </li>
                </ul>
            </div><div class="listHeaderSubList">
                <ul>
                    <li><h2>3: Артиллерия</h2>
                    <ul>                    	<li><p>Может содержать только подразделения артиллерийского класса.</p></li>
                                            	<li><p>Подразделения с самым мощным оружием размещаются первыми.</p></li>
                                            	<li><p>Последовательность нападения: Подразделения рукопашного боя, фланги.</p></li>
                                            </ul>
                    </li>
                </ul>
            </div><div class="listHeaderSubList">
                <ul>
                    <li><h2>4: Подразделения дистанционного взаимодействия</h2>
                    <ul>                    	<li><p>Может содержать только подразделения дистанционного взаимодействия.</p></li>
                                            	<li><p>Подразделения с самым мощным оружием размещаются первыми.</p></li>
                                            	<li><p>Последовательность атаки: Линия ближнего боя, фланги, линия дальнего боя.</p></li>
                                            </ul>
                    </li>
                </ul>
            </div><div class="listHeaderSubList">
                <ul>
                    <li><h2>5: Линия рукопашного боя</h2>
                    <ul>                    	<li><p>Изначально занято тяжелой пехотой. Если таковой нет, то формация выполняется в следующем порядке: <br> <ul> <li> Легкая пехота </li> <li> Бойцы дистанционного действия, которые не имеют аммуниции в запасе </li> </ul></p></li>
                                            	<li><p>Подразделения с меньшим уровнем здоровья, размещаются первыми.</p></li>
                                            	<li><p>Последовательность нападения: Линия рукопашного боя, линия дальнего боя, артиллерия, фланги</p></li>
                                            </ul>
                    </li>
                </ul>
            </div><div class="listHeaderSubList">
                <ul>
                    <li><h2>6: Фланги</h2>
                    <ul>                    	<li><p>Может содержать лишь подразделения "легкой пехоты".</p></li>
                                            	<li><p>Подразделения, которые имеют наименьшее здоровье, размещаются в первую очередь.</p></li>
                                            	<li><p>Очередность атаки: Фланги, линия дальнего боя, артиллерия, линия рукопашного боя</p></li>
                                            </ul>
                    </li>
                </ul>
            </div><div class="listHeaderSubList">
                <ul>
                    <li><h2>7: Противовоздушная оборона</h2>
                    <ul>                    	<li><p>Может содержать только подразделения `противовоздушной обороны`.</p></li>
                                            	<li><p>Подразделения с мощным вооружением размещаются в первую очередь.</p></li>
                                            	<li><p>Последовательность атаки: Бомбардировщики, противовоздушная оборона</p></li>
                                            </ul>
                    </li>
                </ul>
            </div><div class="listHeaderSubList">
                <ul>
                    <li><h2>8: Резервы</h2>
                    <ul>                    	<li><p>Резерв состоит из всех подразделений, не размещенных на поле сражения.</p></li>
                                            </ul>
                    </li>
                </ul>
            </div><div class="content">До шести формирований могут быть размещены на поле сражения. Отдельные формирования на поле битвы будут заполнены подразделениями в следующем порядке: <br/><ul><li> Противовоздушная оборона </li><li> Воздух </li><li> Артиллерия </li><li> Бойцы дистанционного действия </li><li> Рукопашные бойцы </li><li> Фланги </li></ul></div><div class="content">Формирования обеих сторон стреляют в друг друга одновременно. Последовательность выстрела различных формирований - следующее: <br/><ul><li> Противовоздушная оборона </li><li> Воздух </li><li> Фланги </li><li> Артиллерия </li><li> Дистанционные войска </li><li> Главная линия фронта </li></ul></div><div class="content">Маленький город</div><img src="<?=$this->config->item('style_url')?>skin/ikipedia/cityfight_small.gif">&nbsp;&nbsp;<div class="content">Средний город</div><img src="<?=$this->config->item('style_url')?>skin/ikipedia/cityfight_medium.gif">&nbsp;&nbsp;<div class="content">Большой город</div><img src="<?=$this->config->item('style_url')?>skin/ikipedia/cityfight_big.gif">&nbsp;&nbsp;<div class="content">Открытое поле</div><img src="<?=$this->config->item('style_url')?>skin/ikipedia/openfight.gif">&nbsp;&nbsp;<div class="content">Морская битва</div><img src="<?=$this->config->item('style_url')?>skin/ikipedia/seafight.gif">&nbsp;&nbsp;        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Типы подразделений" href="/game/informations/28/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Типы подразделений</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Урон & Потери" href="/game/informations/30/">Урон & Потери<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 30:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Урон & Потери</h1>
<div class="content">У каждого подразделения, которое принимает участие в сражении, есть <b>`здоровье`</b>, измеряемое в пунктах. Если подразделение получает <b>урон</b>, это вычитается из его пунктов здоровья. Если здоровье достигнет ноля, то подразделение будет уничтожено. Чтобы защитить себя, подразделения могут использовать броню.</div><div class="content"><b>Броня</b> снижает урон, наносимый подразделению. Это означает, если подразделение, имеющее 3 единицы брони, получает атаку в 5 урона, то действительный урон будет 5-3=2 единицы здоровья.</div><h2>Рассеивание</h2><div class="content">Все сформированные подразделения вступают в бой одновременно. Мощность нанесения удара зависит от точности оружия. Чем менее точность оружия, тем более высока вероятность распределенного урона, т.е. нанесения вреда многим подразделениям. Высокая скорость атаки, с другой стороны, вызывает большее число урона одновременно.</div><h2>Лечение</h2><div class="content">Если подразделение было только <b>`повреждено`</b>, но не уничтожено и все еще имеет несколько пунктов здоровья, подразделения, обладающие <b>целебными способностями </b> могут восстановить потерянные пункты здоровья в конце раунда. Эти подразделения обычно находятся в поддержке.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Поле битвы" href="/game/informations/29/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Поле битвы</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Мораль" href="/game/informations/31/">Мораль<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 31:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Мораль</h1>
<div class="content">Результат сражения зависит не только от количества солдат и их экипировки, но также и от морали бойцов. Все армии, которые вступают в битву, начинают сражение с полной моралью. После каждого раунда, мораль снижается или увеличивается в зависимости от многих различных факторов. Если мораль достигнет ноля, армия разбежится. Перечисленные ниже факторы играют роль:</div><div class="content">Отрицательные: <br/> <ul> <li> Истощение. Уменьшение морали войск каждый раунд. </li> <li> Ваша сторона несет большие потери, чем сторона противника. </li> <li> Большее количество бойцов борются на вражеской стороне. </li> <li> Оппозициционные силы состоят из большего количества армий. </li> <li> Ваши дистанционные войска и артиллерия подверглись нападению с флангов. </li> <li> Ваши войска разбомблены артиллерией. </li> <li> Произошел прорыв вашей линии рукопашного боя. </li> <li> Вражеская стена не была разрушена должным образом </li> </ul></div><div class="content">Положительные: <br/><ul><li>Чудо Ареса</li><li>Подразделения повышают свою мораль. Обычно это действие осуществляется войсками поддержки.</li></ul></div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Урон & Потери" href="/game/informations/30/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Урон & Потери</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Советы и указания" href="/game/informations/32/">Советы и указания<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 32:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Советы и указания</h1>
<div class="hint">Подразделения рукопашного боя выполняют большую часть работы в сражении. Тяжелая пехота - это единственный вид подразделений, который достаточно силен, чтобы сдержать их атаку.</div><div class="hint">Городские стены крепки и неприступны, поэтому они могут быть повреждены только артиллерийскими подразделениями.</div><div class="hint">Если по прибытии армии на место, в бой на вражеской стороне вступают свои или союзные подразделения, армия прекращает свое задание.</div><div class="hint">Подразделения, выбывшие из родного города, требуют удвоения своего содержания, если находятся в пути или размещены в иностранных городах.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Мораль" href="/game/informations/31/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Мораль</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Морские сражения" href="/game/informations/33/">Морские сражения<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 33:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Морские сражения</h1>
<div class="content">В море есть тоже есть линия рукопашного боя. Быстрые суда могут проплыть вокруг флангов противника - корабли с дистанционным вооружением, с другой стороны, бомбят противника в тылу.</div><div class="content">На море <b>нет городских стен</b> или других типов фортификационных сооружений, поэтому здесь <b>нет артиллерийских кораблей</b>.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Советы и указания" href="/game/informations/32/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Советы и указания</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Оккупация" href="/game/informations/34/">Оккупация<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 34:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Оккупация</h1>
<div class="content">Для оккупации города вы должны следовать ниже приведенным требованиям:</div><div class="list">
                <ul>
                                    <li>Вы должны выполнить исследование `губернатор` в разделе `милитаризм`.</li>
                                    <li>Уровень вашего дворца должен быть больше количества городов доступных для оккупирования.</li>
                                </ul>
            </div><div class="content">Члены вашего альянса могут размещать свои войска и корабли в оккупированных вами городах. Другие действия могут привести к изгнанию их оттуда. Также такое возможно, если оккупированный город будет захвачен.</div><div class="content">Никакие военные действия из оккупированного города не могут быть начаты. Исключением является только попытка восстания оккупированного игрока. Во время оккупации стоимость войск и флота для оккупированного игрока будет в два раза превышать обычную.</div><div class="content">Оккупированный игрок получает 10% от военной добычи оккупирующей армии, возвращающейся с набега. Остальная добыча транспортируется до места назначения, указанного в качестве цели сбора.</div><div class="content">Совет: Если город не будет оккупирован во время возвращения армии, армия разбежится. Товары будут выгружены в город. Если корабли с награбленными товарами при возвращении не наткнутся на блокаду, товары будут отправлены в город, и армия разместится там снова. Очень важно для оккупанта, сохранять контроль над городом и гаванью.</div><div class="content">Вы можете вернуть армию и флот из оккупированного города в любой момент. Вы можете выбрать ваш домашний город из всех ваших городов. Если вы пожелаете прекратить оккупацию, вы можете сделать это во дворце.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Морские сражения" href="/game/informations/33/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Морские сражения</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Шпионаж" href="/game/informations/35/">Шпионаж<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 35:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Шпионаж</h1>
<img src="<?=$this->config->item('style_url')?>skin/img/city/building_safehouse.gif">&nbsp;&nbsp;<div class="content">Со строительством Укрытия вы сможете тренировать шпионов. С каждым увеличением уровня Укрытия Вы сможете тренировать дополнительного шпиона.</div><div class="content">Для отправки шпиона нажмите на карте острова на город, в который Вы хотите его отправить. Опция отправки появится в левом меню. После завершения выбора шпион попытается проникнуть в указанный город.</div><div class="content">Как только шпион успешно пробрался в город, Вы можете назначить ему миссии:</div><div class="list">
                <ul>
                                    <li>Инспектировать ресурсы: Вы получите информацию о ресурсах, размещенных в городе.</li>
                                    <li>Шпионаж за гарнизоном: Вы получите информацию о количестве и видах войск, боевых машин и боевых кораблей, размещенных в городе.</li>
                                    <li>Слежка за передвижением войск и флотов: Вы получите информацию о пунктах отправления и назначения флотов, количестве войск и транспортов, времени их прибытия.</li>
                                    <li>Шпионаж за казной: Вы узнаете о количестве золота в городской казне.</li>
                                    <li>Шпионаж за исследованиями: Вы узнаете о последних изобретениях.</li>
                                    <li>Онлайн-статус - Ты можешь узнать, находится ли этот игрок в онлайн в данный момент.</li>
                                    <li>Слежка за сообщениями: Вы узнаете, с кем велся обмен последними сообщениями. При этом будут видны только темы, но не сам текст сообщений.</li>
                                    <li>Отозвать шпиона: шпион возвращается в Укрытие.</li>
                                </ul>
            </div><img src="<?=$this->config->item('style_url')?>skin/characters/spy_espionage.gif">&nbsp;&nbsp;<div class="content">Каждая шпионская миссия содержит риск разоблачения шпиона. Игрок, поймавший шпиона, может узнать, кто его нанял.</div><div class="content">Следующие факторы влияют на риск обнаружения твоего шпиона:</div><div class="list">
                <ul>
                                    <li>Размер города, в котором должен осуществляться шпионаж: чем больше город, тем  меньше риск разоблачения шпиона.</li>
                                    <li>Уровень Укрытия: чем выше уровень, тем  ниже риск разоблачения шпиона.</li>
                                    <li>(+) Уровень Укрытия</li>
                                    <li>Число чужих шпионов в городе, действующих как контрразведка: чем больше вражеских шпионов в городе, тем выше риск обнаружения собственного шпиона.</li>
                                    <li>(+) Риски Миссий - Повышают шансы на обнаружение, сложные миссии повышают их ещё больше</li>
                                    <li>(+) Оставшийся риск от последней миссии</li>
                                </ul>
            </div><div class="hint">Подсказка: Риск обнаружения сильно увеличивается на короткое время после каждой миссии. Подождите некоторое время, прежде чем отправить шпиона на следущую миссию.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Оккупация" href="/game/informations/34/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Оккупация</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Альянсы и договоры" href="/game/informations/36/">Альянсы и договоры<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 36:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Альянсы и договоры</h1>
<img src="<?=$this->config->item('style_url')?>skin/img/city/building_embassy.gif">&nbsp;&nbsp;<h2>Баллы дипломатии</h2><div class="content">Для соглашений необходимы баллы дипломатии. Получить эти баллы Вы сможете посредством строительства или улучшения посольств. Каждый уровень посольств дает +2 балла.</div><div class="hint">Подсказка: для строительства посольства Вам необходимо знание чужих культур (Мореходство).</div><div class="content">Это означает, что Вы можете заключить только ограниченное кол-во договоров. Поэтому выбирайте лучших союзников.</div><div class="hint">Подсказка: после отмены договора Вы получите баллы дипломатии обратно.</div><div class="hint">Подсказка: советнику по дипломатии всегда известно кол-во баллов.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Шпионаж" href="/game/informations/35/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Шпионаж</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Договор" href="/game/informations/37/">Договор<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 37:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Договор</h1>
<div class="content">Существуют различные типы соглашений, которые Вы можете заключить с другими игроками. Выберите карту острова, на ней - город игрока, затем нажмите на Дипломатию. При составлении сообщения Вы можете выбрать, какое соглашение желаете заключить.</div><h2>Договор о культурных ценностях</h2><div class="content">Прежде чем заключить договор о культ. ценностях, Вам необходимо исследовать Культурный обмен (Наука) и создать по меньшей мере один музей. Теперь Вы можете заключить договор о культ. ценностях с любым другим игроком, у которого есть музей. Для каждого соглашения Вы получаете одну культ. ценность, которую можете выставить в музее. Каждая выставка увеличивает уровень довольства граждан в Вашем городе.</div><div class="hint">Подсказка: количество заключаемых договоров зависит от уровня Вашего музея (1 уровень - 1 договор, и.т.п.). При этом музеи, расположенные во всех Ваших городах, рассматриваются в совокупности. Количество выставленных экземпляров в каждом музее зависит от уровня музея (1 уровень - 1 экземпляр, и.т.д.).</div><h2>Торговый договор</h2><div class="content">Заключение торгового договора между игроками возможно только при исследованном Рынке (ветка мореходства). Торговый договор также даёт Вам преимущественное право первой покупки. Поэтому если Вы выбираете на рынке предложение своего торгового партнёра, то товары будут зарезервированы только для Вас и предложение партнёра будете видеть только Вы.</div><div class="hint">Подсказка: Торговый договор стоит 2 пунктов дипломатии для обеих сторон.</div><h2>Военный договор</h2><div class="content">Как только Вы изучили Дипломатию (Мореходство), Вы можете заключить военный договор с городом другого игрока. Во время действия договора Вы можете разместить свои войска в этом городе (войска потребуют двойного содержания).</div><div class="hint">Подсказка: Заключение Права Гарнизона будет стоить 11 баллов дипломатии для Вас и 2 баллов дипломатии для Вашего партнера.</div><div class="hint">Подсказка: военный договор заключается с конкретным городом. Для доступа в другие города того же самого игрока необходимо заключать отдельные договоры.</div><div class="hint">Подсказка: Принимающей стороне не обязательно наличие открытого исследования "Дипломатия".</div><h2>Право Гарнизона для союзников</h2><div class="content">Как дипломат Вы можете запрашивать Право Гарнизона в нужном городе игрока для всего своего клана (для этого нужна изученная "Дипломатия" в ветке мореходства). Как только договор будет заключен, все члены клана смогут использовать эту колонию как базу для своих будущих военных действий. Размещение войск обойдется в двойное содержание.</div><div class="hint">Подсказка: Заключение Права Гарнизона обойдется в 12 баллов дипломатии для альянса и 4 баллов дипломатии для Вашего партнера.</div><div class="hint">Примечание: Альянс получает очки дипломатии только за счёт очков дипломатии своего лидера.</div><div class="hint">Подсказка: Принимающей стороне не обязательно наличие открытого исследования "Дипломатия".</div><h2>Мирный договор</h2><div class="content">Дипломат клана может заключать мирные договора с другими дипломатами. Если же мирный договор будет нарушен, то каждый дипломат будет уведомлен.</div><div class="hint">Примечание: Если Вы нападете на игрока, с которым у Вас есть мирный договор, то Вы получите предупреждение.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Альянсы и договоры" href="/game/informations/36/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Альянсы и договоры</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Альянсы: Создание и воины" href="/game/informations/38/">Альянсы: Создание и воины<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 38:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Альянсы: Создание и воины</h1>
<div class="content">Вы можете присоединиться к любому альянсу (необходим 1 балл дипломатии).</div><div class="content">Для основания альянса необходимо иметь 3 балла дипломатии.</div><div class="content">Другие игроки могут вступать в Ваш альянс, если у Вас достаточно баллов дипломатии.</div><div class="hint">Подсказка: для роста альянса следует перевести баллы дипломатии альянсу. Нажмите на Посольство и выберите "Передача баллов дипломатии" в левом меню.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Договор" href="/game/informations/37/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Договор</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Альянсы: Предводитель и Советник" href="/game/informations/39/">Альянсы: Предводитель и Советник<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 39:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Альянсы: Предводитель и Советник</h1>
<div class="content">В каждом альянсе имеются 4 поста с присущими каждому из них особенностями.</div><h2>Предводитель</h2><div class="list">
                <ul>
                                    <li>Получает ежедневно небольшое кол-во ресурсов в зависимости от численности и силы воинов альянса.</li>
                                    <li>Может менять имя и тэг альянса.</li>
                                    <li>Может назначать на ведущие посты (Генерал, Дипломат, Советник)</li>
                                    <li>Может распустить альянс.</li>
                                    <li>Может назначить нового предводителя, если у кандидата имеется достаточное кол-во свободных баллов дипломатии.</li>
                                </ul>
            </div><div class="hint">Подсказка: с созданием альянса предводитель автоматически занимает все посты.</div><h2>Советник</h2><div class="list">
                <ul>
                                    <li>Отвечает за прием и и исключение воинов альянса.</li>
                                    <li>Может видеть все ресурсы альянса.</li>
                                    <li>Может назначать ранги альянса.</li>
                                    <li>Может редактировать внутреннюю страницу альянса.</li>
                                </ul>
            </div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Альянсы: Создание и воины" href="/game/informations/38/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Альянсы: Создание и воины</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Альянсы: Генерал и дипломат" href="/game/informations/40/">Альянсы: Генерал и дипломат<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 40:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Альянсы: Генерал и дипломат</h1>
<h2>Генерал</h2><div class="list">
                <ul>
                                    <li>Может видеть все войска и корабли альянса.</li>
                                    <li>Может видеть все атаки альянса.</li>
                                    <li>Может отзывать атаки альянса.</li>
                                </ul>
            </div><h2>Дипломат</h2><div class="list">
                <ul>
                                    <li>Может редактировать внешнюю страницу альянса.</li>
                                    <li>Может управлять соглашением альянса.</li>
                                    <li>Может видеть всех партнеров альянса.</li>
                                    <li>Получает сообщения альянса.</li>
                                </ul>
            </div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Альянсы: Предводитель и Советник" href="/game/informations/39/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Альянсы: Предводитель и Советник</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Религия" href="/game/informations/41/">Религия<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 41:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Религия</h1>
<div class="content">В Древней Греции, существовало огромное количество богов. И не только Греки, а еще и Римляне, известные своими амбициями, всего лишь скопировали греческих богов, изменив им имена! <br/> Конечно, Олимпийские боги ценили развлечения. Но они все были большой семьей. Каждый Бог обладал собственным городом-государством и у каждого под защитой находились верующие. <br/> В Ikariam, каждый <b>остров</b> имеет свою божественную защиту. На каждом острове есть <b>алтарь</b>, который олицетворяет собой божество, наблюдающее за островом. И, естественно, божественная защита создает чудеса для последователей. <br/> Однако за свою помощь - боги требуют что-нибудь взамен.</div><div class="content">Важнейшим элементом божественности является <b>вера</b>.<b /> Вера получается тяжелым путем, особенно в области науки и логики! Божества в первую очередь интересуются тем островом, население которого верит в них.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Альянсы: Генерал и дипломат" href="/game/informations/40/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Альянсы: Генерал и дипломат</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Храмы & Священники" href="/game/informations/42/">Храмы & Священники<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 42:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Храмы & Священники</h1>
<div class="content">Чтобы привлечь жителей для служения Богу, необходимо в городах построить <b>храмы</b> и нанять туда жителей из числа населения города. Каждый священник способен убедить пять жителей острова. Однако это требует не так много времени, люди Ikariam очень набожные и легко убеждаемые.</div><div class="content">Правители, заинтересованные в мощных чудесах, должны вербовать 1/6 населения в священников!</div><div class="content">Чем больше становятся города на острове, тем больше сокращается влияние, оказываемое одним священником. Очень тяжело для правителя, удерживать планку верующих островитян на 100%! Ходят слухи о безрассудных правителях, угрожающих войной тем, кто не помогает в распространении веры.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Религия" href="/game/informations/41/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Религия</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Алтарь" href="/game/informations/43/">Алтарь<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 43:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Алтарь</h1>
<div class="content">Улучшите алтарь. Хотя большая часть работы уже сделана, истинного Бога очень трудно удовлетворить. Алтарь можно улучшить до уровня 5, таким образом верующие могут сделать больше пожертвований, увеличивая божественную мощь. Алтарь является средоточием веры всех народов на острове, если он не будет выстроен полагающим образом, его мощь будет не нужна. Чтобы улучшить алтарь, всем игрокам острова необходимо украсить его ресурсами. Украшение алтаря выполняется всеми ресурсами, кроме тех, что добываются на острове. (Т.е. если у вас остров вина, вы можете вложить в алтарь мрамор, серу и хрусталь для улучшения)</div><div class="content">Однако, вложения в мир богов того стоят. Чем больше процент населения, верующего в Бога, тем больше становится алтарь и мощнее чудо, которое священники просят у Бога острова.</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Храмы & Священники" href="/game/informations/42/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Храмы & Священники</a>                    </td>
                    <td width="50%" align="right">
                    <a title="К теме: Чудеса" href="/game/informations/44/">Чудеса<img align="middle" name="next" onMouseover="next.src='<?=$this->config->item('style_url')?>skin/layout/next-hover.gif';" onMouseout="next.src='<?=$this->config->item('style_url')?>skin/layout/next.gif';" src="<?=$this->config->item('style_url')?>skin/layout/next.gif"></a>                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?case 44:?>
<div id="mainview">
	<div class="informations">
        <h1 class="informationsTitel">Чудеса</h1>
<div class="content">Но как заставить чудеса работать? </br> Как только вы построите <b>храм</b>, священники начнут создавать чудо, обращаясь к Богу острова. Священники очень умны, они создают чудо для всего населения игрока. Это означает, что все города империи будут подвержены чуду, а не только тот город, который находится на острове с алтарем.</div><div class="content">Каждый Бог владеет собственным и неповторимым чудом, чтобы поддержать веру своих последователей. Если у вас есть храм на острове, чудо будет доступно в храме и <b>активировано</b> вами если это потребуется.</div><div class="content">После активации чуда вы должны <b>подождать некоторое время</b> перед тем, как сможете вызвать чудо снова. Божествам не нравится, когда их энергию используют слишком часто, и священники заплатили за это знание тяжкими травмами, прежде чем уяснили это навсегда.</div><div class="content">Чем больше божеств почитаются в империи, тем больше различных типов чудес, может призвать правитель, что дает ему стратегическое преимущество. Если он будет концентрироваться лишь на одном чуде, то получит сокращение времени между вызовом чуда.</div><div class="content">Однажды наступает момент, когда мудрый правитель должен принять решение возводить храм, или сохранить места для зданий, которые служат мирным целям. Это, разумеется, тяжелый выбор!</div>        <div class="navigation">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td width="50%" align="left">
                    <a title="Назад к теме: Алтарь" href="/game/informations/43/"><img align="middle" name="prev" onMouseover="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev-hover.gif';" onMouseout="prev.src='<?=$this->config->item('style_url')?>skin/layout/prev.gif';" src="<?=$this->config->item('style_url')?>skin/layout/prev.gif">Алтарь</a>                    </td>
                    <td width="50%" align="right">
                                        </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer"></div>
</div>
<?break;?>
<?}?>