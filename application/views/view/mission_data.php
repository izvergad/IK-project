<?
    $cost = $this->Data_Model->army_cost_by_type(23, $this->Player_Model->research);
    $x1 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$mission->from]->island]->x;
    $x2 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$mission->to]->island]->x;
    $y1 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$mission->from]->island]->y;
    $y2 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$mission->to]->island]->y;
    $time = $this->Data_Model->time_by_coords($x1,$x2,$y1,$y2,$cost['speed']);
    $elapsed = time() - $mission->mission_start;
    $ostalos = ($time - $elapsed >= 0) ? $time - $elapsed : 0;
    $time_return = ($mission->return_start-$mission->mission_start)*$mission->percent;
    $return_elapsed = time() - $mission->return_start;
    $return_time = ($time_return - $return_elapsed >= 0) ? $time_return - $return_elapsed : 0;