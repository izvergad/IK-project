<?php

class Data_Model extends Model
{

    function Data_Model()
    {
        // Call the Model constructor
        parent::Model();
    }

    function building_name_by_type($type)
    {
        switch($type)
        {
            case 1: return 'Ратуша'; break;
            case 2: return 'Торговый порт'; break;
            default: return 'Пустырь'; break;
        }
    }

    function building_desc_by_type($type)
    {
        switch($type)
        {
            case 1: return 'В центре города расположена ратуша, через которую проходят все городские дела. Работники ратуши с удовольствием проинформируют Вас о местном населении. Каждое улучшение ратуши увеличивает максимальное число граждан в этом городе.'; break;
            case 2: return 'Порт - это Ваши ворота в мир. Здесь можно нанять торговые суда и приготовить их для дальних странствий. Вы можете также получать ценные товары изо всех уголков мира. В больших торговых портах Ваши суда будут загружены быстрее.'; break;
        }
    }

    function building_class_by_type($type)
    {
        switch($type)
        {
            case 1: return 'townHall'; break;
            case 2: return 'port'; break;
            default: return 'buildingGround'; break;
        }
    }

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

    function building_cost($id = 1, $level = 0)
    {
        $wood = ''; $wine = ''; $marble = ''; $crystal = ''; $sulfur = ''; $time = '';
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
    
}
?>
