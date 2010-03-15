<?php
/**
 * Модель управления данными
 */
class Data_Model extends Model
{

    var $temp_towns_db = array();
    var $temp_islands_db = array();
    var $temp_users_db = array();
    var $temp_research_db = array();

    function Data_Model()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    /**
     * Получаем город из базы
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
     * Получаем остров из базы
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
     * Получаем игрока из базы
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
     * Получаем исследования из базы
     */
    function Load_Research($id = 0)
    {
        if ($id > 0)
        {
            if (!isset($temp_research_db[$id]))
            {
                $query = $this->db->get_where($this->session->userdata('universe').'_research', array('user' => $id));
                $return = $query->row();
                // Отправляем в темп
                $this->temp_research_db[$id] = $return;
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
     * Название юнита по типу
     * @param <int> $type
     * @return <string>
     */
    function army_name_by_type($type)
    {
        switch($type)
        {
            case 1: return 'Гоплит'; break;
            case 2: return 'Паровой гигант'; break;
            case 3: return 'Копейщик'; break;
            case 4: return 'Мечник'; break;
            case 5: return 'Пращник'; break;
            case 6: return 'Лучник'; break;
            case 7: return 'Стрелок'; break;
            case 8: return 'Таран'; break;
            case 9: return 'Катапульта'; break;
            case 10: return 'Мортира'; break;
            case 11: return 'Гирокоптер'; break;
            case 12: return 'Бомбардировщик'; break;
            case 13: return 'Повар'; break;
            case 14: return 'Доктор'; break;
            case 15: return 'Варвар с топором'; break;
        }
    }

    /**
     * Описание юнита по типу
     * @param <int> $type
     * @return <string>
     */
    function army_desc_by_type($type)
    {
        switch($type)
        {
            case 1: return 'Гоплиты - тяжелобронированные копейщики. Они составляют сердце греческой армии. В боевом режиме "Фаланга" - они представляют собой устрашающую стену копий и щитов.'; break;
            case 2: return 'Эти крепкие, как сталь, гиганты уже одним своим видом вселяют ужас в самых стойких солдат неприятеля. Один такой монстр способен справиться с десятками обычных солдат. Камни, стрелы и мечи не причиняют ему вреда.'; break;
            case 3: return 'Копейщики призываются из сельских жителей и имеют примитивную броню и легкое копье в качестве оружия. Они не способны противостоять профессиональной армии.'; break;
            case 4: return 'Мечники обычно слабо защищены и дерутся без щитов, чтобы сохранить подвижность. Так они могут обходить фаланги, чтобы атаковать их со стороны.'; break;
            case 5: return 'Пращники очень эффективны на поле боя: их навыки могут часто пригодиться во время сражений, а их содержание не требует специального вооружения и поэтому дешево.'; break;
            case 6: return 'Луки - популярное охотничье оружие. Не составляет труда найти среди жителей лучников и обучить их военной науке.'; break;
            case 7: return 'Стрелок попадает без промаха в любую цель. Только одна шеренга может стрелять, пока остальные перезаряжаются.'; break;
            case 8: return 'Перед мощным тараном задрожат даже самые прочные и надежные городские стены! Кроме высокой разрушительной силы, в этой боевой машине имеется также место для укрытия солдат от стрел, камней и прочих неприятностей.'; break;
            case 9: return 'Выстрел катапульты вносит страх в ряды противника! Катапульты могут разрушать каменные стены, но почти бесполезны в обороне.'; break;
            case 10: return 'Мортиры стреляют разрывными снарядами по стенам осажденного города. Ни одно строение не может противостоять им. Боеприпасы к мортирам трудно достать, поэтому необходимо хорошо целиться, чтобы не расходовать их впустую.'; break;
            case 11: return 'Эта летающая машина надежна и не зависит от направления ветра. Мы можем атаковать трусливых врагов в небесах.'; break;
            case 12: return 'Наши изобретатели открыли, что солнце такое горячее потому, что оно притягивает теплый воздух. Поэтому шар, наполненный горячим воздухом, поднимается к солнцу, и наши солдаты могут кидать бомбы сверху на врагов.'; break;
            case 13: return 'Повара точно знают, как поднять боевой дух солдат - стаканом хорошего вина и миской горячей похлебки. Сытый, отдохнувший солдат - нелегкий противник в бою.'; break;
            case 14: return 'Доктора помогают раненым солдатам во время боя. Удаляют стрелы, перевязывают раны и прикладывают лед к головам пострадавших от камней, пущенных из пращи.'; break;
            case 15: return 'Основными военными частями варваров являются воины, которые бросаются сквозь битву с громкими криками, сеящие хаос на своем пути. Однако они не способны пробиться сквозь стройные ряды Греческих Фаланг со своей примитивной броней.'; break;
        }
    }

    /**
     * Класс юнита по типу
     * @param <int> $type
     * @return <string>
     */
    function army_class_by_type($type)
    {
        switch($type)
        {
            case 1: return 'phalanx'; break;
            case 2: return 'steamgiant'; break;
            case 3: return 'spearman'; break;
            case 4: return 'swordsman'; break;
            case 5: return 'slinger'; break;
            case 6: return 'archer'; break;
            case 7: return 'marksman'; break;
            case 8: return 'ram'; break;
            case 9: return 'catapult'; break;
            case 10: return 'mortar'; break;
            case 11: return 'gyrocopter'; break;
            case 12: return 'bombardier'; break;
            case 13: return 'cook'; break;
            case 14: return 'medic'; break;
            case 15: return 'varvar'; break;
        }
    }

    /**
     * Цены на армию
     * @param <int> $type
     * @return <array>
     */
    function army_cost_by_type($type)
    {
        $type = $type-1;

        $peoples = '1 2 1 1 1 1 1 5 5 5 3 5 1 1';
        $wood = '40 130 30 30 20 30 50 220 260 300 25 40 50 50';
        $sulfur = '30 180 0 30 0 25 150 0 300 1250 100 250 0 0';
        $wine = '0 0 0 0 0 0 0 0 0 0 0 0 250 0';
        $crystal = '0 0 0 0 0 0 0 0 0 0 0 0 0 450';
        $gold = '3 12 1 4 2 4 3 15 25 30 15 45 10 20';
        $time = '0 0 0 0 0 0 0 0 0 0 0 0 0 0';
        
        $peoples_array = explode(' ', $peoples) ;
        $wood_array = explode(' ', $wood) ;
        $sulfur_array = explode(' ', $sulfur) ;
        $wine_array = explode(' ', $wine) ;
        $crystal_array = explode(' ', $crystal) ;
        $gold_array = explode(' ', $gold) ;
        $time_array = explode(' ', $time) ;
        
        $return['peoples'] = ($peoples_array[$type] > 0) ? $peoples_array[$type] : 0;
        $return['wood'] = ($wood_array[$type] > 0) ? $wood_array[$type] : 0;
        $return['sulfur'] = ($sulfur_array[$type] > 0) ? $sulfur_array[$type] : 0;
        $return['wine'] = ($wine_array[$type] > 0) ? $wine_array[$type] : 0;
        $return['crystal'] = ($crystal_array[$type] > 0) ? $crystal_array[$type] : 0;
        $return['gold'] = ($gold_array[$type] > 0) ? $gold_array[$type] : 0;
        $return['time'] = ($time_array[$type] > 0) ? $time_array[$type] : 0;

        return $return;
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
            case 4:
                $wood = '';
                $time = '';
            break;
            case 5:
                $wood = '49 114 195 296 420 574 766 1003 1297 1662 2115 2676 3371 4234 5304 6630 8275 10314 12843 15979 19868 24690 30669 38083 47277 58676 72812 90340 112076 139027 172448';
                $marble = '0 0 0 0 0 0 0 0 178 431 745 1134 1616 2214 2956 3875 5015 6429 8183 10357 13052 16395 20540 25680 32054 39957 49756 61908 76977 95660 118830';
                $time = '396 1044 1321 1626 1962 2330 2736 3183 3660 4200 4800 5460 6180 6960 7800 8760 9840 10980 12240 13680 15180 16920 18780 20820 23040 25560 28260 31260 34560 38220 42240';
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

    function get_position($type = 0, $buildings = array())
    {
        $return = 0;
        for ($i = 0; $i <= 14; $i++)
        {
            if ($buildings[$i]['type'] == $type)
            {
                $return = $i;
            }
        }
        return $return;
    }

    function get_research($way = 1, $id = 1, $research)
    {
        if ($way == 1 and $id > 14){$id = 14;}
        if ($way == 2 and $id > 15){$id = 15;}
        if ($way == 3 and $id > 16){$id = 16;}
        if ($way == 4 and $id > 14){$id = 14;}

        $return['need_way'] = 0;
        $return['need_id'] = 0;
        $return['name'] = '';
        $return['desc'] = '';
        $return['points'] = 0;
        $return['id'] = $id;
        switch($way)
        {
            case 1:
                switch($id)
                {
                    case 1:
                        $return['name'] = 'Плотницкое дело';
                        $return['desc'] = 'Древесина, из зеленых лесов с нашего острова, достаточно крепкая даже для щитов наших фаланг. И деревянные части строения без хлопот выдержат крыши наших зданий. Но чтобы все было должным образом, дерево должно быть тщательно отобрано и обработано! Плотник в нашем городе позаботится об этом и мы будем использовать намного меньше стройматериалов при строительстве! Позволяет: Построение Плотницкой мастерской';
                        $return['points'] = 8;
                    break;
                    case 2:
                        $return['name'] = 'Палубное вооружение';
                        $return['desc'] = 'Наши ученые изобрели способ установки больших баллист на корабли. Вращающийся станок со временем сможет нести все более и более мощные типы орудий. Позволяет: Постройка кораблей с баллистой на верфи';
                        $return['points'] = 12;
                        if ($research->res1_1 == 0){ $return['need_way'] = 1; $return['need_id'] = 1; }
                        elseif ($research->res4_1 == 0){ $return['need_way'] = 4; $return['need_id'] = 1;  }
                    break;
                    case 3:
                        $return['name'] = 'Ремонт кораблей';
                        $return['desc'] = 'Своевременный ремонт и профилактическое обслуживание кораблей позволит им служить дольше и эффективнее. Эффект: Содержание кораблей стоит на 2% меньше';
                        $return['points'] = 24;
                        if ($research->res1_2 == 0){ $return['need_way'] = 1; $return['need_id'] = 2; }
                    break;
                    case 4:
                        $return['name'] = 'Экспансия';
                        $return['desc'] = 'Пришла пора великих открытий! Мы обнаружили другие острова и теперь сможем строить больше городов и добывать больше ресурсов. Наша империя растет! Позволяет: Постройка дворцов, основание колоний';
                        $return['points'] = 336;
                        if ($research->res1_3 == 0){ $return['need_way'] = 1; $return['need_id'] = 3; }
                        elseif ($research->res2_3 == 0){ $return['need_way'] = 2; $return['need_id'] = 3; }
                    break;
                    case 5:
                        $return['name'] = 'Другие культуры';
                        $return['desc'] = 'Знакомство с нравами и обычаями других народов позволит нам сделать значительный шаг вперед на пути собственного прогресса. Дружеские встречи и беседы могут сотворить истинные чудеса и способствовать созданию новых союзов и поддержанию дружественных отношений в целом. Для приема послов из других стран и организации банкетов нам необходимо удобное и просторное здание. Позволяет: Строительство Посольств';
                        $return['points'] = 1032;
                        if ($research->res1_4 == 0){ $return['need_way'] = 1; $return['need_id'] = 4; }
                        elseif ($research->res3_3 == 0){ $return['need_way'] = 3; $return['need_id'] = 3; }
                    break;
                    case 6:
                        $return['name'] = 'Смола';
                        $return['desc'] = 'Наши ученые открыли новый вид смолы, идеально подходящей для осмолки кораблей и увеличения срока их службы. Эффект: Содержание кораблей стоит на 4% меньше';
                        $return['points'] = 2236;
                        if ($research->res1_5 == 0){ $return['need_way'] = 1; $return['need_id'] = 5; }
                    break;
                    case 7:
                        $return['name'] = 'Рынок';
                        $return['desc'] = 'Самые необычные товары с других островов поступают на наши рынки. Здесь мы можем заключать соглашения с торговцами, чтобы получить доступ ко всем необходимым нам ресурсам. Позволяет: Торговые соглашения.';
                        $return['points'] = 3264;
                        if ($research->res1_6 == 0){ $return['need_way'] = 1; $return['need_id'] = 6; }
                        elseif ($research->res2_5 == 0){ $return['need_way'] = 2; $return['need_id'] = 5; }
                    break;
                    case 8:
                        $return['name'] = 'Греческий огонь';
                        $return['desc'] = 'Огонь, который невозможно потушить водой, даст нам небывалые преимущества в морских битвах. Скоро все моря станут нашими! Позволяет: Постройка огненных кораблей';
                        $return['points'] = 7020;
                        if ($research->res1_7 == 0){ $return['need_way'] = 1; $return['need_id'] = 7; }
                        elseif ($research->res3_4 == 0){ $return['need_way'] = 3; $return['need_id'] = 4; }
                    break;
                    case 9:
                        $return['name'] = 'Противовес';
                        $return['desc'] = 'Наши ученые разработали новый тип кораблей с катапультным противовесом, имеющих высокую огневую мощь. При этом они достаточно надежны и не накреняются при выстреле. Позволяет: Строительство катапультных судов на верфи';
                        $return['points'] = 9936;
                        if ($research->res1_8 == 0){ $return['need_way'] = 1; $return['need_id'] = 8; }
                        elseif ($research->res2_7 == 0){ $return['need_way'] = 2; $return['need_id'] = 7; }
                    break;
                    case 10:
                        $return['name'] = 'Дипломатия';
                        $return['desc'] = 'Один из наших философов написал интересный трактат о войне и мире. Он советует заключение альянсов с другими народами, так как намного легче победить врага совместными усилиями, чем в одиночку. Позволяет: Военные договора.';
                        $return['points'] = 17064;
                        if ($research->res1_9 == 0){ $return['need_way'] = 1; $return['need_id'] = 9; }
                        elseif ($research->res4_8 == 0){ $return['need_way'] = 4; $return['need_id'] = 8; }
                   break;
                    case 11:
                        $return['name'] = 'Морские карты';
                        $return['desc'] = 'Наши путешествия станут менее рискованными, если мы занесем на карту все опасные места на море - мели, водовороты и морские пучины. Наши моряки будут знать, как избежать происшествий в плаваниях. Эффект: Содержание кораблей стоит на 8% меньше';
                        $return['points'] = 25632;
                        if ($research->res1_10 == 0){ $return['need_way'] = 1; $return['need_id'] = 10; }
                    break;
                    case 12:
                        $return['name'] = 'Пароходное колесо';
                        $return['desc'] = 'Прекрасная новость для моряков: наши ученые изобрели пароходное колесо. Теперь наши корабли получат небывалые возможности! Все морские державы будут трепетать перед нашими могучими флотами! Позволяет: Постройка пароходов на верфи';
                        $return['points'] = 38400;
                        if ($research->res1_11 == 0){ $return['need_way'] = 1; $return['need_id'] = 11; }
                        elseif ($research->res3_7 == 0){ $return['need_way'] = 3; $return['need_id'] = 7; }
                    break;
                    case 13:
                        $return['name'] = 'Корабельная мортира';
                        $return['desc'] = 'Нам удалось создать гигантские мортиры небывалой мощности. Только бронированный пароход, имеющий достаточно тяги, может нести такую мортиру и боезапас к ней. Позволяет: Постройка мортирных кораблей на верфи';
                        $return['points'] = 93240;
                        if ($research->res1_12 == 0){ $return['need_way'] = 1; $return['need_id'] = 12; }
                        elseif ($research->res3_9 == 0){ $return['need_way'] = 3; $return['need_id'] = 9; }
                    break;
                    case 14:
                        $return['name'] = 'Будущее мореходства';
                        $return['desc'] = 'Наконец-то с помощью последних изобретений мы сможем покорить моря! Наши корабли уже сейчас самые мощные и быстроходные, и мы без страха бороздим на них воды океанов! Эффект: Содержание кораблей стоит на 2% меньше.';
                        $return['points'] = 532800;
                        if ($research->res1_13 == 0){ $return['need_way'] = 1; $return['need_id'] = 13; }
                        elseif ($research->res2_14 == 0){ $return['need_way'] = 2; $return['need_id'] = 14; }
                        elseif ($research->res3_15 == 0){ $return['need_way'] = 3; $return['need_id'] = 15; }
                        elseif ($research->res4_13 == 0){ $return['need_way'] = 4; $return['need_id'] = 13; }
                    break;
                }
            break;
            case 2:
                switch($id)
                {
                    case 1:
                        $return['name'] = 'Хранение';
                        $return['desc'] = 'Мы разработали систему хранения и учета товаров и можем теперь уберечь часть ресурсов даже при атаке врага. Позволяет: Строительство складов';
                        $return['points'] = 12;
                    break;
                    case 2:
                        $return['name'] = 'Шкив';
                        $return['desc'] = 'Уникальная идея: веревка, перекинутая через шкив, позволит поднимать большие тяжести минимальными усилиями. Теперь наши рабочие смогут самостоятельно передвигать громадные каменные глыбы, что ускорит процесс строительства. Эффект: на 2% меньше затрат на строительство';
                        $return['points'] = 24;
                        if ($research->res2_1 == 0){ $return['need_way'] = 2; $return['need_id'] = 1; }
                    break;
                    case 3:
                        $return['name'] = 'Благосостояние';
                        $return['desc'] = 'Земля полна всевозможных сокровищ! Мы изучили как добывать серу и хрусталь и как выбивать мрамор из скал. Мы научились выращивать виноград на плодородных бескрайних холмах и делать вкусное вино! Новая эра процветания начнется для нас, как только мы научимся использовать с умом все эти ресурсы. Мы можем продавать товары через торговый пост и покупать то что требуется у других торговцев. Эффект: Позволяет производить товары, доступен торговый пост и дается 130 единиц роскоши.';
                        $return['points'] = 112;
                        if ($research->res2_2 == 0){ $return['need_way'] = 2; $return['need_id'] = 2; }
                    break;
                    case 4:
                        $return['name'] = 'Винный пресс';
                        $return['desc'] = 'Довольным жизнью гражданам следует веселиться и пить вино, дарованное им Дионисом. Пусть на лицах горожан светятся улыбки! Позволяет: Постройка таверн';
                        $return['points'] = 336;
                        if ($research->res2_3 == 0){ $return['need_way'] = 2; $return['need_id'] = 3; }
                        elseif ($research->res3_1 == 0){ $return['need_way'] = 3; $return['need_id'] = 1; }
                    break;
                    case 5:
                        $return['name'] = 'Увеличение добычи ресурсов';
                        $return['desc'] = 'Прошло уже какое-то время с тех пор, как мы узнали и научились использовать сокровища наших островов для своих нужд. Теперь нам нужно получить не только сильных, но и квалифицированных рабочих для своих карьеров, виноградников, серных выработок и шахт добычи хрусталя. Таким образом добыча увеличится и наша цивилизация станет еще богаче, чем когда-либо!';
                        $return['points'] = 1204;
                        if ($research->res2_4 == 0){ $return['need_way'] = 2; $return['need_id'] = 4; }
                        elseif ($research->res1_4 == 0){ $return['need_way'] = 1; $return['need_id'] = 4; }
                    break;
                    case 6:
                        $return['name'] = 'Геометрия';
                        $return['desc'] = 'Правильные формы при строительстве, строгие углы и изящная архитектура скоро сделают наши города примером для подражания. Эффект: на 4% меньше затраты на строительство';
                        $return['points'] = 2236;
                        if ($research->res2_5 == 0){ $return['need_way'] = 2; $return['need_id'] = 5; }
                    break;
                    case 7:
                        $return['name'] = 'Архитектура';
                        $return['desc'] = 'Хороший дом выстоит при любых условиях. Но он может быть ещё крепче, когда кто-то с ясной головой, точными расчётами и планом построения, позаботится об этом, тогда все стены будут прямыми, а крыша ещё прочнее. Благодаря углу и компасу, наши здания будут более устойчивы и хорошо защищены от дождя. Бюро архитектора сэкономило бы для нас затраты мрамора при строении, только думали бы больше о сбережениях, строя новое здание! Позволяет: Построение Бюро архитектора';
                        $return['points'] = 3672;
                        if ($research->res2_6 == 0){ $return['need_way'] = 2; $return['need_id'] = 6; }
                        elseif ($research->res3_4 == 0){ $return['need_way'] = 3; $return['need_id'] = 4; }
                    break;
                    case 8:
                        $return['name'] = 'Выходной';
                        $return['desc'] = 'Хорошо отдохнувший рабочий работает гораздо эффективнее, чем усталый. Поэтому каждый должнен брать один выходной в неделю. Это непременно отразится на уровне довольства граждан! Эффект: Повышение уровня довольства жизнью во всех городах';
                        $return['points'] = 7200;
                        if ($research->res2_7 == 0){ $return['need_way'] = 2; $return['need_id'] = 7; }
                    break;
                    case 9:
                        $return['name'] = 'Фирменные блюда';
                        $return['desc'] = 'Наша культура достигла необычайных кулинарных высот! Наши солдаты могут получать самую вкусную и полезную пищу, что является основой для поддержания боеготовности армии. Позволяет: Тренировка поваров в казарме';
                        $return['points'] = 10764;
                        if ($research->res2_8 == 0){ $return['need_way'] = 2; $return['need_id'] = 8; }
                        elseif ($research->res1_7 == 0){ $return['need_way'] = 1; $return['need_id'] = 7; }
                    break;
                    case 10:
                        $return['name'] = 'Помощь';
                        $return['desc'] = 'Нашим гражданам необходимо проявить больше ответственности: вместо того чтобы прожигать время, лучше помогли бы рабочим - в шахтах, на лесопилках и виноградниках. Тем самым они принесли бы неимоверную пользу! Позволяет: Дополнительные рабочие места.';
                        $return['points'] = 19908;
                        if ($research->res2_9 == 0){ $return['need_way'] = 2; $return['need_id'] = 9; }
                        elseif ($research->res3_7 == 0){ $return['need_way'] = 3; $return['need_id'] = 7; }
                    break;
                    case 11:
                        $return['name'] = 'Водяной уровень';
                        $return['desc'] = 'Мы изобрели водяной уровень, с помощью которого наши здания приобретут геометрически правильные формы. А самое главное - это то, что нам потребуется намного меньше строительных материалов для возведения зданий! Эффект: Строительство зданий стоит на 8% дешевле';
                        $return['points'] = 25632;
                        if ($research->res2_10 == 0){ $return['need_way'] = 2; $return['need_id'] = 10; }
                    break;
                    case 12:
                        $return['name'] = 'Винный погреб';
                        $return['desc'] = 'Ах эти ежегодные винные пирушки! Ведь это самая лучшая забава для детей - потоптать виноград для вина, жидкое золото плещется везде и весь город находится на ногах! С виноградом, отобранным опытным виноделом для виноградного пресса у нас бы ничего не утекло. Винодел также позаботится о надлежащем хранении, выдержке и крепости вина. Позволяет: Постройка Винного погреба.';
                        $return['points'] = 48000;
                        if ($research->res2_11 == 0){ $return['need_way'] = 2; $return['need_id'] = 11; }
                    break;
                    case 13:
                        $return['name'] = 'Государственный аппарат';
                        $return['desc'] = 'В нашем дворце появилась канцелярия, сотрудники ведут точный учет и статистику. Наконец-то мы сможем заняться строительством новых зданий и их управлением! Позволяет: Дополнительное место для строительства в городах';
                        $return['points'] = 106560;
                        if ($research->res2_12 == 0){ $return['need_way'] = 2; $return['need_id'] = 12; }
                    break;
                    case 14:
                        $return['name'] = 'Утопия';
                        $return['desc'] = 'Наши граждане живут в богатстве и процветании. Они счастливы, здоровы, не обременены хлопотами - словом, наслаждаются безоблачной жизнью. Эффект: +200 мест жилья, +200 довольство жизнью в столице';
                        $return['points'] = 241200;
                        if ($research->res2_13 == 0){ $return['need_way'] = 2; $return['need_id'] = 13; }
                        elseif ($research->res1_10 == 0){ $return['need_way'] = 1; $return['need_id'] = 10; }
                        elseif ($research->res3_13 == 0){ $return['need_way'] = 3; $return['need_id'] = 13; }
                        elseif ($research->res4_11 == 0){ $return['need_way'] = 4; $return['need_id'] = 11; }
                    break;
                    case 15:
                        $return['name'] = 'Будущее экономики';
                        $return['desc'] = 'Наши граждане живут в мире и достатке, торговые прилавки ломятся от деликатесов со всего мира! Улицы содержатся в образцовом порядке, подвоз стройматериалов налажен до безупречности. Эффект: +10 к уровню довольства граждан и +20 к максимальному количеству жителей в каждом городе. Многократное исследование. Эффект умножается на его уровень.';
                        $return['points'] = 532800;
                        if ($research->res2_14 == 0){ $return['need_way'] = 2; $return['need_id'] = 14; }
                        elseif ($research->res1_13 == 0){ $return['need_way'] = 1; $return['need_id'] = 13; }
                        elseif ($research->res3_15 == 0){ $return['need_way'] = 3; $return['need_id'] = 15; }
                        elseif ($research->res4_13 == 0){ $return['need_way'] = 4; $return['need_id'] = 13; }
                    break;
                }
            break;
            case 3:
                switch($id)
                {
                    case 1:
                        $return['name'] = 'Колодец';
                        $return['desc'] = 'Эврика! Колодец на нашем острове! Теперь наши граждане получат воду в любых количествах, а наши поля станут еще более плодородными. Эффект: +50 жилых мест, +50 к уровню довольства в столице';
                        $return['points'] = 24;
                    break;
                    case 2:
                        $return['name'] = 'Бумага';
                        $return['desc'] = 'Мы открыли секрет производства бумаги, что позволит нам документировать и сохранять наши достижения. Эффект: На 2% больше баллов исследований';
                        $return['points'] = 30;
                        if ($research->res3_1 == 0){ $return['need_way'] = 3; $return['need_id'] = 1; }
                    break;
                    case 3:
                        $return['name'] = 'Шпионаж';
                        $return['desc'] = 'Если некоторые из наших граждан поселятся в чужих городах, они смогут оказать помощь в поставке актуальной информации о жизни в местах их нахождения. Например, о проведении нового исследования или о наличие определённых ресурсов в городах. В случае войны они, возможно, даже смогли бы открыть городские ворота для наших войск. Позволяет: Постройка укрытий.';
                        $return['points'] = 420;
                        if ($research->res3_2 == 0){ $return['need_way'] = 3; $return['need_id'] = 2; }
                        elseif ($research->res2_3 == 0){ $return['need_way'] = 2; $return['need_id'] = 3; }
                    break;
                    case 4:
                        $return['name'] = 'Религия';
                        $return['desc'] = 'Человек не способен рационально осмыслить все то, что происходит в мире. И когда он не может объяснить что-либо, за вопросом он обращается к богам. Боги похожи на людей с одной стороны, но они очень отличаются от них с другой. Разве может быть что-то необъяснимое иметь рациональное объяснение? Позволяет: Храмы и Чудеса';
                        $return['points'] = 1428;
                        if ($research->res3_3 == 0){ $return['need_way'] = 3; $return['need_id'] = 3; }
                        elseif ($research->res1_4 == 0){ $return['need_way'] = 1; $return['need_id'] = 4; }
                        elseif ($research->res4_3 == 0){ $return['need_way'] = 4; $return['need_id'] = 3; }
                    break;
                    case 5:
                        $return['name'] = 'Чернила';
                        $return['desc'] = 'Письменные принадлежности можно получить из окружающей нас среды: птицы дают нам свои перья, чтобы писать; в море водятся особые виды рыб, которые вырабатывают вещество, используемое для чернил. Теперь мы сможем увековечить наши идеи! Эффект: на 4% больше баллов исследований';
                        $return['points'] = 2652;
                        if ($research->res3_4 == 0){ $return['need_way'] = 3; $return['need_id'] = 4; }
                    break;
                    case 6:
                        $return['name'] = 'Изобретение';
                        $return['desc'] = 'В последнее время в академиях часто происходят несчастные случаи, связанные с неудачными экспериментами, прежде всего, со взрывами. Поэтому мы оборудовали специальное помещение для опасных экспериментов, где ученые смогут протестировать все самые смелые идеи - ничего страшного, стены выдержат! Позволяет: Строительство мастерских';
                        $return['points'] = 4320;
                        if ($research->res3_5 == 0){ $return['need_way'] = 3; $return['need_id'] = 5; }
                        elseif ($research->res2_5 == 0){ $return['need_way'] = 2; $return['need_id'] = 5; }
                    break;
                    case 7:
                        $return['name'] = 'Культурный обмен';
                        $return['desc'] = 'Наши граждане имеют полное право насладиться шедеврами искусства, созданными талантливыми мастерами со всего света. Точно такое же право имеют и другие народы, которые в свою очередь тоже хотели бы ознакомиться с нашими достижениями искусства. Для этого и существуют музеи! Позволяет: Строительство музеев';
                        $return['points'] = 8694;
                        if ($research->res3_6 == 0){ $return['need_way'] = 3; $return['need_id'] = 6; }
                    break;
                    case 8:
                        $return['name'] = 'Анатомия';
                        $return['desc'] = 'Нам удалось значительно расширить свои познания в области анатомии! При их использовании наши врачи в состоянии оказать помощь раненым солдатам непосредственно на поле битвы и быстро вернуть их в строй. Но и это еще не все! Некоторые медики обладают секретом изготовления целительной микстуры, которая повышает стойкость и силу духа солдат. Позволяет: Набор Докторов в Казарме';
                        $return['points'] = 14952;
                        if ($research->res3_7 == 0){ $return['need_way'] = 3; $return['need_id'] = 7; }
                    break;
                    case 9:
                        $return['name'] = 'Оптика';
                        $return['desc'] = 'Когда наши ученые изобретают новые вещи, то много стекольных изделий могут перебить, либо они затеряются в необъятных лабораториях, поскольку держать всё в порядке – это не приоритет академии. Если бы оптик заботился не только о качестве линз, но и следил за порядком, зная, что каждый прибор будет возвращен на своё место, то мы бы использовали гораздо меньше хрусталя! Позволяет: Построение оптики';
                        $return['points'] = 21360;
                        if ($research->res3_8 == 0){ $return['need_way'] = 3; $return['need_id'] = 8; }
                        elseif ($research->res2_7 == 0){ $return['need_way'] = 2; $return['need_id'] = 7; }
                    break;
                    case 10:
                        $return['name'] = 'Эксперименты';
                        $return['desc'] = 'Наши исследователи хотят проверить свои теории на практике. Эти эксперименты могут значительно ускорить ход исследований, но может потребоваться дополнительное оборудование. Разрешается: приобретение пунктов исследования за хрусталь';
                        $return['points'] = 21360;
                        if ($research->res3_9 == 0){ $return['need_way'] = 3; $return['need_id'] = 9; }
                    break;
                    case 11:
                        $return['name'] = 'Механическая ручка';
                        $return['desc'] = 'Гениальное изобретение: механическая ручка! Одному из ученых удалось совершить прорыв в науке и изобрести механизм, который может записывать устную речь. Теперь мы сможем быстро создавать копии нужных документов, а также более эффективно обмениваться идеями ! Эффект: На 8% больше очков исследований';
                        $return['points'] = 31968;
                        if ($research->res3_10 == 0){ $return['need_way'] = 3; $return['need_id'] = 10; }
                    break;
                    case 12:
                        $return['name'] = 'Полет птицы';
                        $return['desc'] = 'Теперь мы можем летать, как птицы! Мы научились создавать летательные аппараты, которые поднимут человека в небо. Мы сможем обстреливать врага с высоты птичьего полета. Позволяет: Постройка Гирокоптеров в Казарме.';
                        $return['points'] = 46848;
                        if ($research->res3_11 == 0){ $return['need_way'] = 3; $return['need_id'] = 11; }
                        elseif ($research->res4_6 == 0){ $return['need_way'] = 4; $return['need_id'] = 6; }
                    break;
                    case 13:
                        $return['name'] = 'Почтовые трубы';
                        $return['desc'] = 'Чудо свершилось! Теперь мы можем передавать свитки быстро и по назначению с помощью системы почтовых труб. Мы сможем сэкономить на обмене информацией между учеными! Эффект: На 3 ед. золота меньше содержания на каждого ученого';
                        $return['points'] = 144720;
                        if ($research->res3_12 == 0){ $return['need_way'] = 3; $return['need_id'] = 12; }
                        elseif ($research->res1_9 == 0){ $return['need_way'] = 1; $return['need_id'] = 9; }
                        elseif ($research->res2_10 == 0){ $return['need_way'] = 2; $return['need_id'] = 10; }
                        elseif ($research->res4_9 == 0){ $return['need_way'] = 4; $return['need_id'] = 9; }
                    break;
                    case 14:
                        $return['name'] = 'Напорная камера';
                        $return['desc'] = 'Мы научились строить подводные корабли. Теперь все моря станут нашими! Враги даже не заметят тех, кто топит их корабли! Позволяет: Постройка Подлодок на Верфи';
                        $return['points'] = 209880;
                        if ($research->res3_13 == 0){ $return['need_way'] = 3; $return['need_id'] = 13; }
                        elseif ($research->res1_12 == 0){ $return['need_way'] = 1; $return['need_id'] = 12; }
                        elseif ($research->res4_12 == 0){ $return['need_way'] = 4; $return['need_id'] = 12; }
                    break;
                    case 15:
                        $return['name'] = 'Принцип Архимеда';
                        $return['desc'] = 'Нам удалось построить летательный аппарат! Теперь мы сможем запускать в воздух огромные воздушные шары, которые закружат над головами ошеломлённых противников. Мы забросаем их незащищённые головы пчелиными ульями и огненными стрелами! Позволяет: Постройка Бомбардировщиков в Казарме.';
                        $return['points'] = 444000;
                        if ($research->res3_14 == 0){ $return['need_way'] = 3; $return['need_id'] = 14; }
                    break;
                    case 16:
                        $return['name'] = 'Будущее науки';
                        $return['desc'] = 'Лучшие умы империи пытаются найти ответы на вечные вопросы, которые с давних времен интересовали человечество: Кто мы? В чем смысл жизни? Каков истинный порядок вещей? Эффект: На 2% больше баллов исследований.';
                        $return['points'] = 610560;
                        if ($research->res3_15 == 0){ $return['need_way'] = 3; $return['need_id'] = 15; }
                        elseif ($research->res1_13 == 0){ $return['need_way'] = 3; $return['need_id'] = 13; }
                        elseif ($research->res2_14 == 0){ $return['need_way'] = 2; $return['need_id'] = 14; }
                        elseif ($research->res4_13 == 0){ $return['need_way'] = 4; $return['need_id'] = 13; }
                    break;
                }
            break;
            case 4:
                switch($id)
                {
                    case 1:
                        $return['name'] = 'Сухой док';
                        $return['desc'] = 'Мы научились строить корабли в доках и спускать их на воду с минимальными трудозатратами. Наши враги будут повержены на всех морях! Позволяет: Строительство верфей';
                        $return['points'] = 8;
                    break;
                    case 2:
                        $return['name'] = 'Карты';
                        $return['desc'] = 'Долгие марши по крутым горным склонам или через топкие болота измотают любую армию. Теперь нашим войскам нечего бояться - они попадут в нужное место в нужное время, не потеряв в болоте свое оружие. Эффект: Содержание солдат стоит на 2% меньше';
                        $return['points'] = 24;
                        if ($research->res4_1 == 0){ $return['need_way'] = 4; $return['need_id'] = 1; }
                    break;
                    case 3:
                        $return['name'] = 'Профессиональная армия';
                        $return['desc'] = 'Сражаться с врагами - пиратами, варварами и прочими сомнительными личностями - гораздо проще профессионально обученным солдатам. Тренировка стоит недешево, но победы в войнах оправдают все затраты. Позволяет: Тренировка Мечников и Гоплитов в Казарме';
                        $return['points'] = 336;
                        if ($research->res4_2 == 0){ $return['need_way'] = 4; $return['need_id'] = 2; }
                        elseif ($research->res2_3 == 0){ $return['need_way'] = 2; $return['need_id'] = 3; }
                    break;
                    case 4:
                        $return['name'] = 'Осада';
                        $return['desc'] = 'С помощью мощных таранов наши солдаты смогут сокрушить любые стены и быстро захватить любой город! Позволяет: Постройка Таранов в Казарме.';
                        $return['points'] = 1032;
                        if ($research->res4_3 == 0){ $return['need_way'] = 4; $return['need_id'] = 3; }
                        elseif ($research->res3_3 == 0){ $return['need_way'] = 3; $return['need_id'] = 3; }
                    break;
                    case 5:
                        $return['name'] = 'Кодекс чести';
                        $return['desc'] = 'Наши солдаты считают за честь служить в имперской армии! Поэтому они хорошо следят за своим снаряжением, что соответственно уменьшает расходы на содержание. Эффект: на 4% меньше расходов на содержание';
                        $return['points'] = 2236;
                        if ($research->res4_4 == 0){ $return['need_way'] = 4; $return['need_id'] = 4; }
                    break;
                    case 6:
                        $return['name'] = 'Баллистика';
                        $return['desc'] = 'Теперь мы знаем, как поразить врага, используя лук и стрелы! Нужно срочно начать обучение солдат этим навыкам, чтобы лучники присоединились к нашей армии! Позволяет: Тренировка Лучников в Казарме.';
                        $return['points'] = 3264;
                        if ($research->res4_5 == 0){ $return['need_way'] = 4; $return['need_id'] = 5; }
                    break;
                    case 7:
                        $return['name'] = 'Закон рычага';
                        $return['desc'] = 'С применением этой новой технологии мы можем построить мощные метательные машины, которые в состоянии разбить даже городские стены. Позволяет: Постройка Катапульт в Казарме.';
                        $return['points'] = 7020;
                        if ($research->res4_6 == 0){ $return['need_way'] = 4; $return['need_id'] = 6; }
                        elseif ($research->res3_6 == 0){ $return['need_way'] = 3; $return['need_id'] = 6; }
                    break;
                    case 8:
                        $return['name'] = 'Губернатор';
                        $return['desc'] = 'Отсылка управленческого аппарата на места поможет рациональному управлению захваченным городом. Мы можем не только грабить, но и умело использовать награбленное! Богатство других поможет процветанию наших собственных городов. Позволяет: Оккупация.';
                        $return['points'] = 11592;
                        if ($research->res4_7 == 0){ $return['need_way'] = 4; $return['need_id'] = 7; }
                        elseif ($research->res2_4 == 0){ $return['need_way'] = 2; $return['need_id'] = 4; }
                    break;
                    case 9:
                        $return['name'] = 'Пиротехника';
                        $return['desc'] = 'Сера - действительно опасное вещество! И с каждым новым составом смеси мы можем получить намного больше пользы от этого драгоценного ресурса. А безопасное осваивание практики позволит нашим пиротехникам проверять свои изобретения без включения близлежащих зданий, как ненамеренные цели в их эксперименты. У нас будет лучший порох и взрывчатые вещества, что позволит сохранить нам огромное количество серы! Позволит: Построение Полигона пиротехника';
                        $return['points'] = 19908;
                        if ($research->res4_8 == 0){ $return['need_way'] = 4; $return['need_id'] = 8; }
                        elseif ($research->res2_5 == 0){ $return['need_way'] = 2; $return['need_id'] = 5; }
                    break;
                    case 10:
                        $return['name'] = 'Логистика';
                        $return['desc'] = 'Сохранность снаряжения и бодрость наших солдат напрямую зависит от обеспечения армейских грузоперевозок. Эффект: Содержание армии стоит на 8% меньше';
                        $return['points'] = 25632;
                        if ($research->res4_9 == 0){ $return['need_way'] = 4; $return['need_id'] = 9; }
                    break;
                    case 11:
                        $return['name'] = 'Порох';
                        $return['desc'] = 'Черная пороховая смесь, изобретенная алхимиками, имеет огромную силу. Теперь мы можем строить ружья, которые принесут врагу смерть и разрушение. Позволяет: Тренировка Стрелков в Казарме.';
                        $return['points'] = 38400;
                        if ($research->res4_10 == 0){ $return['need_way'] = 4; $return['need_id'] = 10; }
                        elseif ($research->res3_9 == 0){ $return['need_way'] = 3; $return['need_id'] = 9; }
                    break;
                    case 12:
                        $return['name'] = 'Робототехника';
                        $return['desc'] = 'Наши учёные построили огромного человекоподобного робота с гигантскими железными мускулами и сердцем, функционирующим при помощи парового двигателя. Враги задрожат от страха только от одного вида этого гиганта! Позволяет: Постройка Паровых гигантов в Казарме.';
                        $return['points'] = 106560;
                        if ($research->res4_11 == 0){ $return['need_way'] = 4; $return['need_id'] = 11; }
                    break;
                    case 13:
                        $return['name'] = 'Литье пушек';
                        $return['desc'] = 'Качество нашего металла улучшается с каждым днем: уже стало возможным изготавливать орудия из металла, с помощью которых мы можем нанести более точные удары по врагу, а также больший урон. А если мы начнем бомбардировку, то под раскатами канонады задрожат вражеские стены! Позволяет: Постройка Мортир в Казарме.';
                        $return['points'] = 209040;
                        if ($research->res4_12 == 0){ $return['need_way'] = 4; $return['need_id'] = 12; }
                    break;
                    case 14:
                        $return['name'] = 'Будущее армии';
                        $return['desc'] = 'Наши военные машины потрясают своей мощью, наши солдаты хорошо обучены и дисциплинированы! Наш тыл великолепно организован. Все работает четко и без сбоев, что позволяет сэкономить на содержании. Эффект: Содержание войск стоит на 2% меньше.';
                        $return['points'] = 532800;
                        if ($research->res4_13 == 0){ $return['need_way'] = 4; $return['need_id'] = 13; }
                        elseif ($research->res1_13 == 0){ $return['need_way'] = 1; $return['need_id'] = 13; }
                        elseif ($research->res2_14 == 0){ $return['need_way'] = 2; $return['need_id'] = 14; }
                        elseif ($research->res3_15 == 0){ $return['need_way'] = 3; $return['need_id'] = 15; }
                    break;
                }
            break;
        }
        $parametr = 'res'.$way.'_'.$id;
        if ($research->$parametr > 0){ $return['points'] = $return['points'] * ($research->$parametr + 1);}
        return $return;
    }

    /**
     * Название чуда по типу
     * @param <int> $type
     * @return <string>
     */
    function get_wonder_by_type($type)
    {
        switch($type)
        {
            case 1: return 'Кузница Гефеста'; break;
            case 2: return 'Святая Роща Аида'; break;
            case 3: return 'Сады Деметры'; break;
            case 4: return 'Храм Афины'; break;
            case 5: return 'Храм Гермеса'; break;
            case 6: return 'Крепость Ареса'; break;
            case 7: return 'Храм Посейдона'; break;
            case 8: return 'Колосс'; break;
        }
    }

}

/* End of file data_model.php */
/* Location: ./system/application/models/data_model.php */