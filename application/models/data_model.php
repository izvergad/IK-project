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
            default: return 'Пустырь'; break;
        }
    }

    function building_class_by_type($type)
    {
        switch($type)
        {
            case 1: return 'townHall'; break;
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

    function peoples_by_level($level)
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
}
?>
