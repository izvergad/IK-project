<?php

    /**
     * Форматирование времени
     * @param <int> $seconds
     * @return <string>
     */
    function format_time($seconds)
    {
        $days = floor($seconds/86400);
        $hours = floor(($seconds-($days*86400))/3600);
        $minutes = floor(($seconds-($days*86400)-($hours*3600))/60);
        $seconds = floor($seconds-($days*86400)-($hours*3600)-($minutes*60));
        $return = '';
        $times_count = 0;
        if ($days > 0 and $times_count < 2)
        {
            $times_count++;
            $return .= $days.'д. ';
        }
        if ($hours > 0 and $times_count < 2)
        {
            $times_count++;
            $return .= $hours.'ч. ';
        }
        if ($minutes > 0 and $times_count < 2)
        {
            $times_count++;
            $return .= $minutes.'мин. ';
        }
        if ($seconds > 0 and $times_count < 2)
        {
            $times_count++;
            $return .= $seconds.'с. ';
        }
        
        return $return;
    }

    function premium_time($seconds)
    {
        $days = floor($seconds/86400)+1;
        $return = '';
        $return .= ($days > 0) ? $days.'д. ' : '';
        return $return;
    }

    /**
     * Генерация ключа
     * @param <int> $length
     * @return <string>
     */
    function random_key($length = 0)
    {
        $arr = array('a','b','c','d','e','f',
                     'g','h','i','j','k','l',
                     'm','n','o','p','r','s',
                     't','u','v','x','y','z',
                     'A','B','C','D','E','F',
                     'G','H','I','J','K','L',
                     'M','N','O','P','R','S',
                     'T','U','V','X','Y','Z',
                     '1','2','3','4','5','6',
                     '7','8','9','0');
        $pass = "";
        if ($length > 0)
        for($i = 0; $i < $length; $i++)
        {
          $index = rand(0, count($arr) - 1);
          $pass .= $arr[$index];
        }
        return $pass;
    }

    function resource_icon($type)
    {
        switch($type)
        {
            case 1: return 'wine'; break;
            case 2: return 'marble'; break;
            case 3: return 'glass'; break;
            case 4: return 'sulfur'; break;
            default: return 'wood'; break;
        }
    }


/* End of file ikariam_helper.php */
/* Location: ./system/application/helpers/ikariam_helper.php */