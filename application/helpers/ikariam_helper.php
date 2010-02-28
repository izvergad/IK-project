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
        $return .= ($days > 0) ? $days.'д. ' : '';
        $return .= ($hours > 0) ? $days.'ч. ' : '';
        $return .= ($minutes > 0) ? $minutes.'мин. ' : '';
        $return .= ($seconds > 0) ? $seconds.'с. ' : '';
        return $return;
    }

/* End of file ikariam_helper.php */
/* Location: ./system/application/helpers/ikariam_helper.php */