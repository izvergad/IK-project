<?
    // Пока что берем данные сухогруза, а потом будут братсья данные всех кораблей
    $cost = $this->CI->Data_Model->army_cost_by_type(23, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->town_id]);
    // Заносим координаты
    $x1 = $this->CI->Data_Model->temp_islands_db[$this->CI->Data_Model->temp_towns_db[$mission->from]->island]->x;
    $x2 = $this->CI->Data_Model->temp_islands_db[$this->CI->Data_Model->temp_towns_db[$mission->to]->island]->x;
    $y1 = $this->CI->Data_Model->temp_islands_db[$this->CI->Data_Model->temp_towns_db[$mission->from]->island]->y;
    $y2 = $this->CI->Data_Model->temp_islands_db[$this->CI->Data_Model->temp_towns_db[$mission->to]->island]->y;
    // Время пути из одного конца в другой
    $time = $this->CI->Data_Model->time_by_coords($x1,$x2,$y1,$y2,$cost['speed']);
    // Прошло времени с момента начала миссии
    $mission_elapsed = time() - $mission->mission_start;
    // Осталось до конца миссии
    $mission_end = $time - $mission_elapsed;
    // Если загрузки не было в начале значит она должна быть в конце пути
    $loading_time = 0;
    if($mission->loading_from_start == $mission->mission_start)
    {
       // Получаем город
       $trade_town = $this->Data_Model->temp_towns_db[$mission->to];
       // Загружаем модель игрока, к которому плывем
       $this->CI->load->model('Player_Model','Trade_Player');
       $this->CI->Trade_Player->Load_Player($trade_town->user);
       // Находим скорость загрузки в чужом порту
       $port_speed = $this->Data_Model->speed_by_port_level($this->CI->Trade_Player->levels[$mission->to][2]);
       // Длительность загрузки
       $loading_time = ($all_resources/($port_speed / 60));
    }
    // Осталось до конца загрузки
    $loading_end = $mission_end + $loading_time;
    // Осталось до возврата
    // $return_end = ($mission->return_start-$mission->mission_start)*$mission->percent;
    // Если мы возвращаемся
    $return_end = 2147483647;
    if ($mission->return_start > 0)
    {
        // Время возврата
        $return = $time - ($time * $mission->percent);
        $return_elapsed = time() - $mission->return_start;
        // Осталось до возврата
        $return_end = ($return - $return_elapsed >= 0) ? $return - $return_elapsed : 0;
    }

/*
    $cost = $this->Data_Model->army_cost_by_type(23, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->town_id]);
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
    if ($mission->mission_start == 0)
    {
        $elapsed_port = time() - $mission->loading_from_start;
        $port_speed = $this->Data_Model->speed_by_port_level($this->Player_Model->levels[$this->Player_Model->town_id][2]);
        $all_resources = $mission->wood + $mission->marble + $mission->wine + $mission->crystal + $mission->sulfur + $mission->peoples;
        $all_time = ($all_resources/($port_speed / 60));
        if($all_time <= $elapsed_port){ $port_time = 0; } else { $port_time = $all_time - $elapsed_port; }
    }
    $port_ostalos = 0;
    if ($mission->mission_type == 3)
    {
        $this->Data_Model->Load_Town($mission->to);
        $trade_town = $this->Data_Model->temp_towns_db[$mission->to];
        $elapsed_port = time() - $mission->mission_start - $time;
        $port_position = $this->Data_Model->get_position(12, $trade_town);
        $level_text = 'pos'.$port_position.'_level';
        $port_level = $trade_town->$level_text;
        $port_speed = $this->Data_Model->speed_by_port_level($port_level);
        $all_resources = $mission->trade_wood_count + $mission->trade_wine_count + $mission->trade_marble_count + $mission->trade_crystal_count + $mission->trade_sulfur_count;
        $all_time = ($all_resources/($port_speed / 60));
        if($all_time <= $elapsed_port){ $port_time = 0; } else { $port_time = $all_time - $elapsed_port; }
        $return_time = $return_time + $port_time;
        $port_ostalos = ($time - $elapsed + $port_time >= 0) ? $time - $elapsed + $port_time : 0;
    }


*/