<?php
/**
 * Модель управления данными
 */
class Data_Model extends Model
{

    var $temp_towns_db = array();
    var $temp_islands_db = array();
    var $temp_users_db = array();

    function Data_Model()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    /**
     * Получаем город из темпа или из базы
     */
    function Load_Town($id = 0)
    {
        if ($id > 0)
        {
            if (!isset($temp_towns_db[$id]))
            {
                $query = $this->db->get_where($this->session->userdata('universe').'_towns', array('id' => $id));
                $return = $query->row();
                // Отправляем в темп
                $this->temp_towns_db[$id] = $return;
            }
        }
    }

    /**
     * Получаем остров из темпа или из базы
     */
    function Load_Island($id = 0)
    {
        if ($id > 0)
        {
            if (!isset($temp_islands_db[$id]))
            {
                $query = $this->db->get_where($this->session->userdata('universe').'_islands', array('id' => $id));
                $return = $query->row();
                // Отправляем в темп
                $this->temp_islands_db[$id] = $return;
            }
        }
    }

    /**
     * Получаем игрока из темпа или из базы
     */
    function Load_User($id = 0)
    {
        if ($id > 0)
        {
            if (!isset($temp_users_db[$id]))
            {
                $query = $this->db->get_where($this->session->userdata('universe').'_users', array('id' => $id));
                $return = $query->row();
                // Отправляем в темп
                $this->temp_users_db[$id] = $return;
            }
        }
    }

    /**
     * Имя шахты по типу
     * @param <int> $id
     * @return <string>
     */
    function island_building_by_resource($id)
    {
        switch($id)
        {
            case 1: return 'Виноградники'; break;
            case 2: return 'Карьер'; break;
            case 3: return 'Шахта добычи хрусталя'; break;
            case 4: return 'Выработка серы'; break;
            default: return 'Лес'; break;
        }
    }

    /**
     * Имя здания по типу
     * @param <int> $type
     * @return <string>
     */
    function building_name_by_type($type)
    {
        switch($type)
        {
            case 1: return 'Ратуша'; break;
            case 2: return 'Торговый порт'; break;
            case 3: return 'Академия'; break;
            case 4: return 'Верфь'; break;
            case 5: return 'Казарма'; break;
            case 6: return 'Склад'; break;
            case 7: return 'Городская стена'; break;
            case 8: return 'Таверна'; break;
            case 9: return 'Музей'; break;
            case 10: return 'Дворец'; break;
            case 11: return 'Посольство'; break;
            case 12: return 'Рынок'; break;
            case 13: return 'Мастерская'; break;
            case 14: return 'Укрытие'; break;
            case 15: return 'Резиденция губернатора'; break;
            case 16: return 'Хижина Лесничего'; break;
            case 17: return 'Каменоломня'; break;
            case 18: return 'Стеклодувная Мастерская'; break;
            case 19: return 'Винодельня'; break;
            case 20: return 'Башня Алхимика'; break;
            case 21: return 'Плотницкая мастерская'; break;
            case 22: return 'Бюро Архитектора'; break;
            case 23: return 'Оптика'; break;
            case 24: return 'Винный погреб'; break;
            case 25: return 'Полигон Пиротехника'; break;
            case 26: return 'Храм'; break;
            default: return 'Пустырь'; break;
        }
    }

    /**
     * Описание здания по типу
     * @param <int> $type
     * @return <string>
     */
    function building_desc_by_type($type)
    {
        switch($type)
        {
            case 1: return 'В центре города расположена ратуша, через которую проходят все городские дела. Работники ратуши с удовольствием проинформируют Вас о местном населении. Каждое улучшение ратуши увеличивает максимальное число граждан в этом городе.'; break;
            case 2: return 'Порт - это Ваши ворота в мир. Здесь можно нанять торговые суда и приготовить их для дальних странствий. Вы можете также получать ценные товары изо всех уголков мира. В больших торговых портах Ваши суда будут загружены быстрее.'; break;
            case 3: return 'Академия - это источник мудрости, где древние знания применяются в сочетании с современными технологиями. Мудрейшие головы Вашего города толпятся у входа и ждут, когда наконец перед ними распахнутся двери! Но учтите, что каждый ученый нуждается в своей собственной лаборатории, которая стоит денег. Чем больше академия, тем больше ученых Вы можете использовать одновременно.'; break;
            case 4: return 'Чем была бы островная империя без флота? На верфи могучие боевые корабли готовятся для долгих путешествий по океанам. Пусть все семь морей дрожат перед ними! По мере улучшения верфи появляется возможность закладывать новые виды кораблей и скорость их постройки увеличивается.'; break;
            case 5: return 'В казарме буйная молодёжь проходит хорошую школу и превращается в смелых бойцов. Ваши солдаты умеют обращаться с мечами, копьями и катапультами, а также в состоянии самостоятельно управлять мощными боевыми машинами. По мере улучшения казармы появляется возможность найма новых видов войск и увеличивается скорость их обучения.'; break;
            case 6: return 'Часть Ваших ресурсов хранится на складе, предлагая им отличную защиту от воров, а также от неблагоприятных погодных условий, птиц, мелкого зверья и прочих вредителей. Заведующий складом обладает детальной информацией о всех запасах. Улучшение склада позволит защитить большее количество ресурсов от внешних условий.'; break;
            case 7: return 'Городская стена защитит Ваших граждан не только от солнца, но и от врагов. Но помните, что противник не спит: он будет пытаться пробить бреши в стене или преодолеть ее каким-либо другим образом.'; break;
            case 8: return 'После окончания работы нет ничего более приятного, чем кувшин вина - поэтому таверна считается очень популярным местом среди Ваших граждан. Улучшив настроение приятной порцией вина, они начинают петь песни, символизируя таким образом конец трудового дня. Каждое улучшение таверны позволяет Вам разливать больше вина для утомившихся граждан.'; break;
            case 9: return 'В музее Ваши граждане могут подивиться на культурные достижения других народов. Чтобы устраивать большие выставки, необходимо улучшать музей. Каждое улучшение музея позволяет Вам выставлять дополнительные экспонаты.'; break;
            case 10: return 'Дворец - это место, из которого происходит управление империей. Отсюда можно, помимо занятия имперскими делами, наслаждаться превосходным видом на море. Каждое улучшение дворца Вашей столицы позволяет строить новую колонию.'; break;
            case 11: return 'Посольство - шумное место, где кипит бурная деятельность: дипломаты со всех континентов договариваются о контрактах, заключают соглашения и создают альянсы. Для увеличения численности альянса Вам необходимо улучшать своё посольство. Каждый уровень посольства увеличивает Ваши баллы дипломатии. Начиная с 3-го уровня у Вас появляется возможность основать свой альянс.'; break;
            case 12: return 'Торговцы и купцы заключают свои сделки в здании рынка. Там всегда можно найти подходящую сделку или урвать лакомый кусочек. Купцы из дальних стран предпочитают заезжать на крупные и известные рынки. Радиус действия Вашего рынка расширяется с каждым вторым улучшением.'; break;
            case 13: return 'Наиболее квалифицированные работники города заняты в мастерской, где они внедряют новейшие изобретения в улучшение снаряжения для войск и оборудование для военных кораблей. Каждая стадия улучшения мастерской позволит выполнять больше усовершенствований для войск и судов.'; break;
            case 14: return 'У мудрого лидера всегда имеется информация как о врагах,так и о союзниках. Укрытие позволяет Вам нанимать шпионов, которые предоставят конфиденциальную информацию о происшествиях в других городах. Чем больше укрытие, тем больше шпионов можно нанять.'; break;
            case 15: return 'Губернатор колонии гарантирует, что все ежедневные административные задачи выполняются должным образом. Таким образом он понижает уровень упадка Вашей колонии. Резиденция губернатора должна быть улучшена до дворца, если Вы захотите перенести столицу.'; break;
            case 16: return 'Сильные дровосеки способны вырубать даже самые большие деревья. Но они также знают, что на месте старых нужно сажать новые деревья, чтобы непрерывно получать лучшую древесину для строительства наших зданий. Каждый уровень строения увеличивает добычу стройматериалов на 2%.'; break;
            case 17: return 'Обученный каменщик подберёт, поломает и принесёт мрамор нужного размера. С помощью него наши строители всегда будут обеспечены нужными каменными блоками для строительства. С каждым уровнем расширения каменоломни добыча мрамора увеличивается на 2%.'; break;
            case 18: return 'Обработка хрусталя и надувка стекла - вот чем занимаются здесь мастера, знающие все тонкости производства. Именно поэтому наши сверкающие шедевры из стекла настолько прочны, что практически никогда не ломаются. Каждый уровень строения увеличивает добычу хрусталя на 2%.'; break;
            case 19: return 'Виноделы выбирают только самые солнечные холмы чтобы покрыть их зеленым успокоением из виноградных лоз. Так будет выращен и отобран самый лучший виноград для урожая. С каждым уровнем расширения винодельни добыча винограда увеличится на 2%.'; break;
            case 20: return 'Когда дует западный ветер, сернистый запах заполняет улицы вокруг лаборатории, и многие жители не покидают дома без затычек для носа. Наши алхимики непрерывно работают над поиском идеальной смеси, чтобы добывать из шахты ещё больше серы. Каждый уровень строения увеличивает добычу серы на 2%.'; break;
            case 21: return 'Умелыми плотниками используется только самая лучшая древесина, поэтому наши здания крепки и практически не нуждаются в ремонте. Каждый уровень строения уменьшает затраты древесины в городе.'; break;
            case 22: return 'Компас, линейка и угольник: в Бюро Архитектора есть всё необходимое для построения ровных стен и устойчивых крыш. Правильно спроектированным зданиям потребуется намного меньше мрамора. Каждый уровень строения уменьшает затраты мрамора на 1% в Вашем городе.'; break;
            case 23: return 'Линзы и лупы позволяют не только чётко видеть нашим учёным или найти важные бумаги на столе, а также они необходимы для изобретения новых технологий, которыми мы так гордимся. У оптика всё в идеальном порядке, что нам может понадобиться, и уж точно ничего не потеряется. С каждым улучшением этого здания расход хрусталя в этом городе уменьшается на 1%.'; break;
            case 24: return 'Только самые креплёные вина настаиваются в глубоких подвалах нашего города. И винодел проследит, чтобы вино не просочилось никуда и пробежало только по горлам наших жителей. С каждым уровнем расширения погреба потребление вина в городе снижается на 1%.'; break;
            case 25: return 'Эксперименты пиротехников частенько приводят к воспламенению близлежащих зданий. Но этого не избежать, ведь наши исследователи пробуют новые смеси снова и снова, стараясь оптимизировать расход серы. К счастью, мелкие пожары не очень опасны, поэтому жители, благодарные пиротехникам за красочные фейерверки, зажигающие ночное небо по праздникам, быстро их тушат. Каждый уровень строения уменьшает затраты серы на 1% в городе.'; break;
            case 26: return 'Храм является местом веры, надежды и размышлений. В нем живут священники, которые превозносят Бога, и распространяют его слова по всему острову. Здесь также можно вызвать чудеса, но лишь в том случае, если Бог получит достаточное уважение.'; break;
        }
    }

    /**
     * Тип здания по классу
     * @param <string> $class
     * @return <int>
     */
    function building_type_by_class($class)
    {
        switch($class)
        {
            case 'townHall': return 1; break;
            case 'port': return 2; break;
            case 'academy': return 3; break;
            case 'shipyard': return 4; break;
            case 'barracks': return 5; break;
            case 'warehouse': return 6; break;
            case 'wall': return 7; break;
            case 'tavern': return 8; break;
            case 'museum': return 9; break;
            case 'palace': return 10; break;
            case 'embassy': return 11; break;
            case 'branchOffice': return 12; break;
            case 'workshop': return 13; break;
            case 'safehouse': return 14; break;
            case 'palaceColony': return 15; break;
            case 'forester': return 16; break;
            case 'stonemason': return 17; break;
            case 'glassblowing': return 18; break;
            case 'winegrower': return 19; break;
            case 'alchemist': return 20; break;
            case 'carpentering': return 21; break;
            case 'architect': return 22; break;
            case 'optician': return 23; break;
            case 'vineyard': return 24; break;
            case 'fireworker': return 25; break;
            case 'temple': return 26; break;
        }
    }

    /**
     * Класс здания по типу
     * @param <int> $type
     * @return <string>
     */
    function building_class_by_type($type)
    {
        switch($type)
        {
            case 1: return 'townHall'; break;
            case 2: return 'port'; break;
            case 3: return 'academy'; break;
            case 4: return 'shipyard'; break;
            case 5: return 'barracks'; break;
            case 6: return 'warehouse'; break;
            case 7: return 'wall'; break;
            case 8: return 'tavern'; break;
            case 9: return 'museum'; break;
            case 10: return 'palace'; break;
            case 11: return 'embassy'; break;
            case 12: return 'branchOffice'; break;
            case 13: return 'workshop'; break;
            case 14: return 'safehouse'; break;
            case 15: return 'palaceColony'; break;
            case 16: return 'forester'; break;
            case 17: return 'stonemason'; break;
            case 18: return 'glassblowing'; break;
            case 19: return 'winegrower'; break;
            case 20: return 'alchemist'; break;
            case 21: return 'carpentering'; break;
            case 22: return 'architect'; break;
            case 23: return 'optician'; break;
            case 24: return 'vineyard'; break;
            case 25: return 'fireworker'; break;
            case 26: return 'temple'; break;
            default: return 'buildingGround'; break;
        }
    }

    /**
     * Название ресурса по типу
     * @param <int> $type
     * @return <string>
     */
    function resource_name_by_type($type)
    {
        switch($type)
        {
            case 1: return 'Виноград'; break;
            case 2: return 'Мрамор'; break;
            case 3: return 'Хрусталь'; break;
            case 4: return 'Сера'; break;
            default: return 'Стройматериалы'; break;
        }
    }

    /**
     * Название класса ресурса по типу
     * @param <int> $type
     * @return <string>
     */
    function resource_class_by_type($type)
    {
        switch($type)
        {
            case 1: return 'wine'; break;
            case 2: return 'marble'; break;
            case 3: return 'crystal'; break;
            case 4: return 'sulfur'; break;
            default: return 'wood'; break;
        }
    }

    /**
     * Количество жителей от уровня
     * @param <int> $level
     * @return <int>
     */
    function peoples_by_level($level = 1)
    {
        switch($level)
        {
            case 1: return 60; break;
            case 2: return 96; break;
            case 3: return 142; break;
            case 4: return 200; break;
            case 5: return 262; break;
            case 6: return 332; break;
            case 7: return 410; break;
            case 8: return 492; break;
            case 9: return 580; break;
            case 10: return 672; break;
            case 11: return 768; break;
            case 12: return 870; break;
            case 13: return 976; break;
            case 14: return 1086; break;
            case 15: return 1200; break;
            case 16: return 1320; break;
            case 17: return 1440; break;
            case 18: return 1566; break;
            case 19: return 1696; break;
            case 20: return 1828; break;
            case 21: return 1964; break;
            case 22: return 2102; break;
            case 23: return 2296; break;
            case 24: return 2440; break;
            case 25: return 2590; break;
            case 26: return 2740; break;
            case 27: return 2894; break;
            case 28: return 3002; break;
            case 29: return 3162; break;
            case 30: return 3326; break;
            case 31: return 3492; break;
            case 32: return 3710; break;
            case 33: return 3880; break;
            case 34: return 4054; break;
            case 35: return 4230; break;
            case 36: return 4410; break;
            case 37: return 4590; break;
            case 38: return 4774; break;
            case 39: return 4960; break;
            case 40: return 5184; break;
            case 41: return 5340; break;
            case 42: return 5532; break;
            case 43: return 5728; break;
            case 44: return 5926; break;
            case 45: return 6126; break;
            case 46: return 6328; break;
            case 47: return 6534; break;
            case 48: return 6760; break;
        }
        return ($level > 48) ? 6760 + (($level - 48) * 250) : 60;
    }

    function scientists_by_level($level = 0)
    {
        switch($level)
        {
            case 0: return 0; break;
            case 1: return 8; break;
            case 2: return 12; break;
            case 3: return 16; break;
            case 4: return 22; break;
            case 5: return 28; break;
            case 6: return 35; break;
            case 7: return 43; break;
            case 8: return 51; break;
            case 9: return 60; break;
            case 10: return 69; break;
            case 11: return 79; break;
            case 12: return 89; break;
            case 13: return 100; break;
            case 14: return 111; break;
            case 15: return 122; break;
            case 16: return 134; break;
            case 17: return 146; break;
            case 18: return 159; break;
            case 19: return 172; break;
            case 20: return 185; break;
            case 21: return 198; break;
            case 22: return 212; break;
            case 23: return 227; break;
            case 24: return 241; break;
            case 25: return 256; break;
            case 26: return 271; break;
            case 27: return 287; break;
            case 28: return 302; break;
        }
        if ($level > 28){ $return = 300 + (($level - 28)*20); return $return;}
        // На будущее по 20 ученых на каждом уровне
    }

    /**
     * Цены, время на шахты, количество работников
     * @param <int> $id
     * @param <int> $level
     * @return <array>
     */
    function island_cost($id = 0, $level = 0)
    {
        $wood = ''; $workers = ''; $time = ''; $max_level = 0;
        switch($id)
        {
            case 0:
                $wood = '0 394 992 1732 2788 3783 5632 8139 10452 13298 18478 23213 29038 39494 49107 66010 81766 101146 134598 154304 205012 270839 311541 411229 506475 665201 767723 1007959 1240496 1526516 1995717 2311042 3020994 3935195 4572136 5624478 7325850 9011590';
                $workers = '30 38 50 64 80 96 114 134 154 174 196 218 240 264 288 314 340 366 394 420 448 478 506 536 566 598 628 660 692 724 758 790 824 860 894 928 964 1000';
                $time = '0 1512 2383 3342 4380 5520 6540 8220 9720 11460 13320 15360 17640 20100 22860 25680 29160 32820 36780 41220 46080 51420 57240 63660 70800 78600 86400 93600 104400 115200 129600 144000 158400 176400 194400 212400 234000 259200';
            break;
            case 1:
            case 2:
            case 3:
            case 4:
                $wood = '0 1303 2689 4373 7421 10037 13333 20665 26849 37305 47879 65572 89127 106217 152739 193512 244886 309618 414190 552058 660106 925396 1108885 1471979 1855942 2339735 3096779 3903252 5153666';
                $workers = '20 32 48 66 88 110 132 158 184 212 240 270 302 332 366 400 434 468 504 542 578 618 656 696 736 776 818 860 904';
                $time = '0 3024 4740 6660 8760 11100 13620 16440 19500 22920 26640 30660 35100 39300 45720 51720 58320 65640 73680 90000 100800 111600 126000 140400 154800 174360 190800 212400';
            break;
        }
        if ($wood != '')
        {
            $wood_array = explode(' ', $wood) ;
            $return['wood'] = ($wood_array[$level] > 0) ? $wood_array[$level] : 0;
            $max_level = count($wood_array)-1;
        }else{$return['wood'] = 0;}
        if ($workers != '')
        {
            $workers_array = explode(' ', $workers) ;
            $return['workers'] = ($workers_array[$level] > 0) ? $workers_array[$level] : 0;
            $max_level = count($workers_array)-1;
        }else{$return['workers'] = 0;}
        if ($time != '')
        {
            $time_array = explode(' ', $time) ;
            $return['time'] = ($time_array[$level] > 0) ? $time_array[$level] : 0;
            $max_level = count($time_array)-1;
        }else{$return['time'] = 0;}
        $return['max_level'] = $max_level;
        return $return;
    }

    /**
     * Цены на здания и время построек
     * @param <int> $id
     * @param <int> $level
     * @return <array>
     */
    function building_cost($id = 1, $level = 0)
    {
        $wood = ''; $wine = ''; $marble = ''; $crystal = ''; $sulfur = ''; $time = ''; $max_level = 0;
        switch($id)
        {
            case 1:
                $wood = '0 158 335 623 923 1390 2015 2706 3661 4776 6173 8074 10281 13023 16424 20986 25423 32285 40232 49286 61207 74804 93956 113035 141594 170213 210011 258875 314902 387655 471194 572580 695615 854728 1037814 1274043 1714396 1876185 2276285 2761291 3384433 4061703 4975980 6032502 7312522 8861330 10846841 13016620';
                $marble = '0 0 0 0 285 551 936 1411 2091 2945 4072 5664 7637 10214 13575 18254 23250 31022 40599 52216 68069 87316 115101 145326 191053 241039 312128 403824 515592 666227 850031 1084292 1382826 1783721 2273685 2930330 3692589 4756439 6058680 7716365 9929883 12512054 16094037 20485822 26073281 33181278 42636728 53722706';
                $time = '0 3544 3960 4440 4980 5640 6480 7380 8460 9720 11160 12900 14880 17280 20040 23220 27000 31440 36600 42660 49740 57960 67680 78960 90000 104400 122400 144000 169200 198000 234000 273600 320400 374400 439200 511200 597600 702000 820800 961200 1125360 1314000 1537200 1800000 2106000 2552400 2883600 3373200';
            break;
            case 2:
                $wood = '60 150 274 492 637 894 1207 1645 2106 2735 3537 4492 5689 7103 8850 11094 13731 17062 21097 25965 31810 39190 47998 58713 71955 87627 94250 130776 159019 193936 235848 286513 348718 423990 513947 625160';
                $marble = '0 0 0 0 0 176 326 540 791 1138 1598 2176 2928 3859 5051 6628 8566 11089 14265 18241 23197 29642 37636 47703 60556 76366 85042 122156 153753 194088 244300 307173 386955 486969 610992 796302';
                $time = '1008 1386 1821 2321 2895 3557 4260 5160 6180 7320 8640 10200 11940 13980 16260 18960 22020 25560 29640 34320 39720 45900 52980 61214 70620 81420 93600 108000 115200 140400 162000 187200 216000 252000 288000 331200';
            break;
            case 3:
                $wood = '64 68 115 263 382 626 982 1330 2004 2665 3916 5156 7446 9753 12751 18163 23691 33450 43571 56728 73832 103458 144203 175057 243929 317207 439967 536309 743789 1027469';
                $crystal = '0 0 0 0 225 428 744 1089 1748 2454 3786 5216 7862 10729 14599 21627 29321 43020 58213 78724 106414 154857 224146 282571 408877 552140 795252 1006646 1449741 2079650';
                $time = '504 1354 1768 2266 2863 3580 4440 5460 6660 8160 9960 12060 14640 17760 21420 25860 31200 37560 45240 54480 65520 78720 93600 111600 133200 162000 194400 234000 280800 338400';
            break;
        }
        if ($wood != '')
        {
            $wood_array = explode(' ', $wood) ;
            $return['wood'] = ($wood_array[$level] > 0) ? $wood_array[$level] : 0;
            $max_level = count($wood_array)-1;
        }else{$return['wood'] = 0;}
        if ($wine != '')
        {
            $wine_array = explode(' ', $wine) ;
            $return['wine'] = ($wine_array[$level] > 0) ? $wine_array[$level] : 0;
            $max_level = count($wine_array)-1;
        }else{$return['wine'] = 0;}
        if ($marble != '')
        {
            $marble_array = explode(' ', $marble) ;
            $return['marble'] = ($marble_array[$level] > 0) ? $marble_array[$level] : 0;
            $max_level = count($marble_array)-1;
        }else{$return['marble'] = 0;}
        if ($crystal != '')
        {
            $crystal_array = explode(' ', $crystal) ;
            $return['crystal'] = ($crystal_array[$level] > 0) ? $crystal_array[$level] : 0;
            $max_level = count($crystal_array)-1;
        }else{$return['crystal'] = 0;}
        if ($sulfur != '')
        {
            $sulfur_array = explode(' ', $sulfur) ;
            $return['sulfur'] = ($sulfur_array[$level] > 0) ? $sulfur_array[$level] : 0;
            $max_level = count($sulfur_array)-1;
        }else{$return['sulfur'] = 0;}
        if ($time != '')
        {
            $time_array = explode(' ', $time) ;
            $return['time'] = ($time_array[$level] > 0) ? $time_array[$level] : 0;
            $max_level = count($time_array)-1;
        }else{$return['time'] = 0;}
        $return['max_level'] = $max_level;
        return $return;
    }

    /**
     * Название счастья по количеству
     * @param <int> $count
     * @return <string>
     */
    function good_name_by_count($count = 0)
    {
        if ($count <= -50)
        {
            return 'Ярость';
        }
        elseif($count > -50 and $count <= -1)
        {
            return 'Горе';
        }
        elseif($count >= 0 and $count < 50)
        {
            return 'Нейтрально';
        }
        elseif($count >= 50 and $count < 300)
        {
            return 'Счастье';
        }
        elseif($count >= 300)
        {
            return 'Эйфория';
        }
    }

    /**
     * Класс счастья по количеству
     * @param <int> $count
     * @return <string>
     */
    function good_class_by_count($count = 0)
    {
        if ($count <= -50)
        {
            return 'outraged';
        }
        elseif($count > -50 and $count <= -1)
        {
            return 'sad';
        }
        elseif($count >= 0 and $count < 50)
        {
            return 'neutral';
        }
        elseif($count >= 50 and $count < 300)
        {
            return 'happy';
        }
        elseif($count >= 300)
        {
            return 'ecstatic';
        }
    }


    /**
     * Очередь построек
     * @param <string> $text
     */
    function load_build_line($text)
    {
            if ($text != '')
            {
                $build_line = explode(";", $text);
                for ($i = 0; $i < count($build_line); $i++)
                {
                    if ($build_line[$i] != '')
                    {
                        $temp_data = explode(",", $build_line[$i]);
                        $build_line[$i] = array();
                        $build_line[$i]['position'] = $temp_data[0];
                        $build_line[$i]['type'] = $temp_data[1];
                        //$already_build[$temp_data[1]] = true;
                    }
                }
                return $build_line;
            }
    }

}

/* End of file data_model.php */
/* Location: ./system/application/models/data_model.php */