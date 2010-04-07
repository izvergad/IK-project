<?
    $cost = $this->CI->Data_Model->army_cost_by_type(23, $this->Player_Model->research);
    $x1 = $this->CI->Data_Model->temp_islands_db[$this->CI->Data_Model->temp_towns_db[$mission->from]->island]->x;
    $x2 = $this->CI->Data_Model->temp_islands_db[$this->CI->Data_Model->temp_towns_db[$mission->to]->island]->x;
    $y1 = $this->CI->Data_Model->temp_islands_db[$this->CI->Data_Model->temp_towns_db[$mission->from]->island]->y;
    $y2 = $this->CI->Data_Model->temp_islands_db[$this->CI->Data_Model->temp_towns_db[$mission->to]->island]->y;
    $time = $this->CI->Data_Model->time_by_coords($x1,$x2,$y1,$y2,$cost['speed']);
    $elapsed = time() - $mission->mission_start;
    $ostalos = ($time - $elapsed >= 0) ? $time - $elapsed : 0;
    $return_time = -1;
    if ($mission->return_start > 0)
    {
        $time_return = ($mission->return_start-$mission->mission_start)*$mission->percent;
        $return_elapsed = time() - $mission->return_start;
        $return_time = ($time_return - $return_elapsed >= 0) ? $time_return - $return_elapsed : 0;
    }