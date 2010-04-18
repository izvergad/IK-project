<?php
/**
 * Контроллер действий
 */
class Actions extends Controller
{

    function Actions()
    {
        parent::Controller();
        $this->load->model('Player_Model');
        if (!$this->session->userdata('login'))
        {
            $this->Player_Model->Error('Ваша сессия истекла, войдите снова!');
        }
        else
        {
            // Загружаем пользователя
            $this->Player_Model->Load_Player($this->session->userdata('id'));
        }
    }

    /**
     * Переход на страницу ошибок
     * @param <string> $error
     */
    function Error($error = '')
    {
                $this->session->set_flashdata(array('game_error' => $error));
                redirect('/game/error/', 'refresh');
    }
    
    /**
     * Обучение: Переход к следующему обучению
     * @param <string> $action
     */
    function tutorials($action, $id = 0)
    {
        $id = floor($id);
        switch($action)
        {
            // следующий этап обучения
            case 'next':
                //$this->Player_Model->user->tutorial = $this->Player_Model->user->tutorial + 1;
                $this->db->query('UPDATE `'.$this->session->userdata('universe').'_users'.'` SET `tutorial`=`tutorial`+1 WHERE `id`="'.$this->session->userdata('id').'"');
            break;
            // установка этапа
            case 'set':
                //$this->Player_Model->user->tutorial = $id;
                $this->db->query('UPDATE `'.$this->session->userdata('universe').'_users'.'` SET `tutorial`='.$id.' WHERE `id`="'.$this->session->userdata('id').'"');
            break;
        }
    }

    /**
     * Повышение уровня здания
     * @param <int> $position
     */
    function upgrade($position)
    {
        $position = floor($position);
        $level_text = 'pos'.$position.'_level';
        $type_text = 'pos'.$position.'_type';
        if ($this->Player_Model->now_town->$level_text > 0){
            $this->build($position, $this->Player_Model->now_town->$type_text, $this->Data_Model->building_class_by_type($this->Player_Model->now_town->$type_text));
        }
        else
        {
            redirect($this->config->item('base_url').'game/', 'refresh');
        }
    }

    /**
     * Понижение уровня здания
     * @param <int> $position
     */
    function demolition($position)
    {
        $position = floor($position);
        
        if ($position > 0 or $this->Player_Model->build_line[$this->Player_Model->town_id][0]['type'] == 1)
        {
            $level_text = 'pos'.$position.'_level';
            $type_text = 'pos'.$position.'_type';
            // Уровень здания
            $level = $this->Player_Model->now_town->$level_text;
            $type = $this->Player_Model->now_town->$type_text;
            // Получаем цены
            if ($this->Player_Model->now_town->build_line != '' and $this->Player_Model->build_line[$this->Player_Model->town_id][0]['position'] == $position)
            {
                $cost = $this->Data_Model->building_cost($type,$level, $this->Player_Model->research,$this->Player_Model->levels[$this->Player_Model->town_id]);
            }
            else
            {
                $cost = $this->Data_Model->building_cost($type,$level-1,$this->Player_Model->research,$this->Player_Model->levels[$this->Player_Model->town_id]);
                $level = ($level > 0) ? $level - 1 : $level;
            }
            //Если это академия обнуляем ученых
            if ($type == 3 and $level == 0)
            {
                $this->Player_Model->now_town->peoples = $this->Player_Model->now_town->peoples + $this->Player_Model->now_town->scientists;
                $this->Player_Model->now_town->scientists = 0;
                $this->db->set('peoples', $this->Player_Model->now_town->peoples);
                $this->db->set('scientists', $this->Player_Model->now_town->scientists);
            }
            // Добавляем 90% ресурсов
            $wood = $this->Player_Model->now_town->wood + ($cost['wood']*0.9);
            $wine = $this->Player_Model->now_town->wine + ($cost['wine']*0.9);
            $marble = $this->Player_Model->now_town->marble + ($cost['marble']*0.9);
            $crystal = $this->Player_Model->now_town->crystal + ($cost['crystal']*0.9);
            $sulfur = $this->Player_Model->now_town->sulfur + ($cost['sulfur']*0.9);
            // Если есть очередь и здание в ней
            if ($this->Player_Model->now_town->build_line != '' and $this->Player_Model->build_line[$this->Player_Model->town_id][0]['type'] == $type)
            {
                // Убираем здание из очереди
                if (sizeof($this->Player_Model->build_line[$this->Player_Model->town_id]) > 1)
                {
                    if ($this->Player_Model->build_line[$this->Player_Model->town_id][0]['position'] < 10)
                    {
                        $build_line = ($this->Player_Model->build_line[$this->Player_Model->town_id][0]['type'] < 10) ? substr($this->Player_Model->now_town->build_line, 4) : substr($this->Player_Model->now_town->build_line, 5);
                    }
                    else
                    {
                        $build_line = ($this->Player_Model->build_line[$this->Player_Model->town_id][0]['type'] < 10) ? substr($this->Player_Model->now_town->build_line, 5) : substr($this->Player_Model->now_town->build_line, 6);
                    }
                    $build_start = $this->Player_Model->now_town->build_start;
                }
                else
                {
                    $build_line = '';
                    $build_start = 0;
                }
                // Если все еще есть очередь
                if ($build_line != '')
                {
                    $do = true;
                    while ($do)
                    {
                        // Стоимость след. здания
                        $buildings = $this->Data_Model->load_build_line($build_line);
                        $level_text = 'pos'.$buildings[0]['position'].'_level';
                        $type_text = 'pos'.$buildings[0]['position'].'_type';
                        $type = $this->Player_Model->now_town->$type_text;
                        $next_level = $this->Player_Model->now_town->$level_text;
                        $cost = $this->Data_Model->building_cost($type, $next_level, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->town_id]);
                        // Если хватает ресурсов
                        if (($wood - $cost['wood']) >= 0 and ($wine - $cost['wine']) >= 0 and ($marble - $cost['marble']) >= 0 and ($crystal - $cost['crystal']) >= 0 and ($sulfur - $cost['sulfur']) >= 0)
                        {
                            $wood = $wood - $cost['wood'];
                            $wine = $wine - $cost['wine'];
                            $marble = $marble - $cost['marble'];
                            $crystal = $crystal - $cost['crystal'];
                            $sulfur = $sulfur - $cost['sulfur'];
                            $do = false;
                            break;
                        }
                        else
                        {
                            // Если не хватает уменьшаем очередь
                            if ($buildings[0]['position'] < 10)
                            {
                                $build_line = ($type < 10) ? substr($build_line, 4) : substr($build_line, 5);
                            }
                            else
                            {
                                $build_line = ($type < 10) ? substr($build_line, 5) : substr($build_line, 6);
                            }
                        }
                    }
                }
                // Проверка данных, чтобы не писать в БД лишнего
                if (strlen($build_line) < 3){ $build_line = ''; }
                if ($build_line == ''){ $build_start = 0; }
                // Пишем в БД
                $this->db->set('build_line', $build_line);
                $this->db->set('build_start', $build_start);
            }
            // Если уровеня нет, то сносим с карты
            if ($level <= 0){ $this->Player_Model->now_town->$type_text = 0; }
            // Пишем в БД
            $this->db->set('pos'.$position.'_level', $level);
            $this->db->set('pos'.$position.'_type', $this->Player_Model->now_town->$type_text);
            $this->db->set('wood', $wood);
            $this->db->set('wine', $wine);
            $this->db->set('marble', $marble);
            $this->db->set('crystal', $crystal);
            $this->db->set('sulfur', $sulfur);
            $this->db->where(array('id' => $this->Player_Model->town_id));
            $this->db->update($this->session->userdata('universe').'_towns');
        }
        else
        {
            $this->Error('Невозможно понизить уровень Ратуши!');
        }
        // Возвращаемся в игру
        redirect($this->config->item('base_url').'game/', 'refresh');
    }

    /**
     * Постройка здания
     * @param <int> $position
     * @param <int> $id
     * @param <bool> $redirect
     */
    function build($position, $id, $redirect = 'city')
    {
        $id = floor($id);
        $position = floor($position);
        $redirect = strip_tags($redirect);
        $level_text = 'pos'.$position.'_level';
        $type_text = 'pos'.$position.'_type';
        $level = $this->Player_Model->now_town->$level_text;
        $type = $this->Player_Model->now_town->$type_text;
        $class = $this->Data_Model->building_class_by_type($id);
        $already_position = $this->Data_Model->get_position($id, $this->Player_Model->now_town);
        if ((($already_position == 0 or $already_position == $position) or $id == 6) and
            $class != 'buildingGround' and
            ($id != 5 or ($id == 5 and $this->Player_Model->armys[$this->Player_Model->town_id]->army_line == '')) and
            ($id != 13 or $this->Player_Model->research->res2_13 > 0) and
            ($type == 0 or $type == $id) and
            (SizeOf($this->Player_Model->build_line[$this->Player_Model->town_id]) <= $this->config->item('town_queue_size')) and (SizeOf($this->Player_Model->build_line[$this->Player_Model->town_id]) > 0 and $this->Player_Model->user->premium_account > 0) or SizeOf($this->Player_Model->build_line[$this->Player_Model->town_id]) == 0)
        {
            // Получаем цены
            $cost = $this->Data_Model->building_cost($id, $level, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->town_id]);
            // Подсчитываем остаток
            $wood = $this->Player_Model->now_town->wood - $cost['wood'];
            $wine = $this->Player_Model->now_town->wine - $cost['wine'];
            $marble = $this->Player_Model->now_town->marble - $cost['marble'];
            $crystal = $this->Player_Model->now_town->crystal - $cost['crystal'];
            $sulfur = $this->Player_Model->now_town->sulfur - $cost['sulfur'];

            // Если остаток приемлемый
            if ($wood >= 0 and $wine >= 0 and $marble >= 0 and $crystal >= 0 and $sulfur >= 0)
            {
                if ($this->Player_Model->now_town->build_line == '')
                {
                    // Обновляем ресурсы в базе и в модели
                    $this->db->set('wood', $wood); //$this->Town_Model->resources['wood'] = $wood;
                    $this->db->set('wine', $wine); //$this->Town_Model->resources['wine'] = $wine;
                    $this->db->set('marble', $marble); //$this->Town_Model->resources['marble'] = $marble;
                    $this->db->set('crystal', $crystal); //$this->Town_Model->resources['crystal'] = $crystal;
                    $this->db->set('sulfur', $sulfur); //$this->Town_Model->resources['sulfur'] = $sulfur;
                }
                // Строка текста прямо как в базе
                if ($this->Player_Model->now_town->build_line != '')
                {
                    $this->db->set('build_line', $this->Player_Model->now_town->build_line.';'.$position.','.$id);
                    //$this->Town_Model->build_text = $this->Town_Model->build_text.';'.$position.','.$id;
                }
                else
                {
                    $this->db->set('build_line', $position.','.$id);
                    //$this->Town_Model->build_text = $this->Town_Model->build_text.$position.','.$id;
                }
                // Устанавливаем время старта если его нету
                if ($this->Player_Model->now_town->build_start == 0)
                {
                    $this->db->set('build_start', time());
                    //$this->Town_Model->build_start = time();
                }
                $this->db->where(array('id' => $this->Player_Model->town_id));
                $this->db->update($this->session->userdata('universe').'_towns');
                // Здание добавлено в очередь
                // Обновляем обучения если есть
                        if ($id == 3 and $this->Player_Model->user->tutorial <= 4)
                        {
                            // Построили академию
                            $this->tutorials('set', 5);
                        }
                        if ($id == 5 and $this->Player_Model->user->tutorial <= 8)
                        {
                            // Построили казарму
                            $this->tutorials('set', 9);
                        }
                        if ($id == 7 and $this->Player_Model->user->tutorial <= 11)
                        {
                            // Построили стену
                            $this->tutorials('set', 12);
                        }
                        if ($id == 2 and $this->Player_Model->user->tutorial <= 13)
                        {
                            // Построили порт
                            $this->tutorials('set', 14);
                        }
                        if ($level > 0 and  $this->Player_Model->user->tutorial <= 15)
                        {
                            // Апгрейдили здание
                            $this->tutorials('set', 16);
                        }

            }
        }
        // Переход на страницу игры
        if ($redirect == 'city')
        {

        }
        if ($redirect)
        {
            if ($redirect == 'warehouse')
            {
                redirect($this->config->item('base_url').'game/'.$redirect.'/'.$position.'/', 'refresh'); 
            }
            else
            {
                redirect($this->config->item('base_url').'game/'.$redirect.'/', 'refresh'); 
            }
        }
    }

    /**
     * Переименовать город
     */
    function rename()
    {
        if (isset($_POST['name']) and strip_tags($_POST['name']) != '')
        {
           $this->db->set('name', strip_tags($_POST['name']));
           $this->db->where(array('id' => $this->Player_Model->town_id));
           $this->db->update($this->session->userdata('universe').'_towns');
        }
        redirect($this->config->item('base_url').'game/townHall/', 'refresh');
    }

    /**
     * Обновляем рабочих
     * @param <string> $type
     * @param <int> $id
     */
    function workers($type = 'resource', $id = 0)
    {
        // Обучение - найм рабочих на лесопилку
        if ($type == 'resource' and $this->Player_Model->user->tutorial <= 2)
        {
            $this->tutorials('set', 3);
        }    
        if ($type == 'academy' and $this->Player_Model->user->tutorial <= 6)
        {
            $this->tutorials('set', 7);
        }
        // Рабочие
        if (isset($_POST['rw']))
        {
            $level = $this->Player_Model->now_island->wood_level;
            $cost = $this->Data_Model->island_cost(0, $level);
            if ($cost['workers'] >= $_POST['rw'])
            {
                $all = $this->Player_Model->now_town->workers + $this->Player_Model->now_town->peoples;
                if ($all >= $_POST['rw'])
                {
                    $this->Player_Model->now_town->workers = floor($_POST['rw']);
                    $this->Player_Model->now_town->peoples = $all - floor($_POST['rw']);
                    $this->db->set('workers', $this->Player_Model->now_town->workers);
                    $this->db->set('peoples', $this->Player_Model->now_town->peoples);
                    $this->db->where(array('id' => $this->Player_Model->town_id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }
        // Рабочие 2
        if (isset($_POST['tw']))
        {
            $level = $this->Player_Model->now_island->trade_level;
            $cost = $this->Data_Model->island_cost(1, $level);
            if ($cost['workers'] >= $_POST['tw'])
            {
                $all = $this->Player_Model->now_town->tradegood + $this->Player_Model->now_town->peoples;
                if ($all >= $_POST['tw'])
                {
                    $this->Player_Model->now_town->tradegood = floor($_POST['tw']);
                    $this->Player_Model->now_town->peoples = $all - floor($_POST['tw']);
                    $this->db->set('tradegood', $this->Player_Model->now_town->tradegood);
                    $this->db->set('peoples', $this->Player_Model->now_town->peoples);
                    $this->db->where(array('id' => $this->Player_Model->town_id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }
        // Ученые
        if (isset($_POST['s']) and $id > 0 and $this->Player_Model->already_build[$this->Player_Model->town_id][3])
        {
            $level_text = 'pos'.$id.'_level';
            $type_text = 'pos'.$id.'_type';
            $level = $this->Player_Model->now_town->$level_text;
            $max_scientists = $this->Data_Model->scientists_by_level($level);
            if ($max_scientists >= $_POST['s'])
            {
                $all = $this->Player_Model->now_town->scientists + $this->Player_Model->now_town->peoples;
                if ($all >= $_POST['s'] )
                {
                    $this->Player_Model->now_town->scientists = floor($_POST['s']);
                    $this->Player_Model->now_town->peoples = $all - floor($_POST['s']);
                    $this->db->set('scientists', $this->Player_Model->now_town->scientists);
                    $this->db->set('peoples', $this->Player_Model->now_town->peoples);
                    $this->db->where(array('id' => $this->Player_Model->town_id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }
        // Возвращаемся в игру
        redirect($this->config->item('base_url').'game/'.$type.'/', 'refresh');
    }

    function resources($type = 'resource', $id = 0)
    {
        $count = isset($_POST['donation']) ? floor($_POST['donation']) : 0;
        if($this->Player_Model->now_town->wood >= $count and $count > 0 and $this->Player_Model->island_id == $id)
        {
            // Обновляем город
            if ($type == 'resource')
            {
                $this->db->set('workers_wood', $this->Player_Model->now_town->workers_wood + $count);
            }
            else
            {
                $this->db->set('tradegood_wood', $this->Player_Model->now_town->tradegood_wood + $count);
            }
            $this->db->set('wood', $this->Player_Model->now_town->wood - $count);
            $this->db->where(array('id' => $this->Player_Model->town_id));
            $this->db->update($this->session->userdata('universe').'_towns');
            // Обновляем остров
            if ($type == 'resource')
            {
                $this->db->query('UPDATE `'.$this->session->userdata('universe').'_islands'.'` SET `wood_count`=`wood_count`+'.$count.' WHERE `id`="'.$id.'"');
            }
            else
            {
                $this->db->query('UPDATE `'.$this->session->userdata('universe').'_islands'.'` SET `trade_count`=`trade_count`+'.$count.' WHERE `id`="'.$id.'"');
            }
        }
        redirect($this->config->item('base_url').'game/'.$type.'/'.$id.'/', 'refresh');
    }

    function doResearch($way = 0, $id = 0)
    {
        $way = floor($way);
        $id = floor($id);
        if($way > 0 and $way <= 4)
        {
            $parametr = 'res'.$way.'_'.$id;
            $data = $this->Data_Model->get_research($way,$id,$this->Player_Model->research);
            if ($this->Player_Model->research->points >= $data['points'])
            {
                $this->db->set('points', $this->Player_Model->research->points - $data['points']);
                $this->db->set('way'.$way.'_checked', 0);
                $this->db->set($parametr, $this->Player_Model->research->$parametr + 1);
                $this->db->where(array('user' => $this->Player_Model->user->id));
                $this->db->update($this->session->userdata('universe').'_research');
                // Благосостояние
                if($way == 2 and $id == 3)
                {
                    $this->db->set('wood', $this->Player_Model->now_town->wood + 130);
                    $this->db->set('marble', $this->Player_Model->now_town->marble + 130);
                    $this->db->set('wine', $this->Player_Model->now_town->wine + 130);
                    $this->db->set('crystal', $this->Player_Model->now_town->crystal + 130);
                    $this->db->set('sulfur', $this->Player_Model->now_town->sulfur + 130);
                    $this->db->where(array('id' => $this->Player_Model->town_id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }
        redirect($this->config->item('base_url').'game/researchAdvisor/', 'refresh');
    }

    /**
     * Конкретный остров
     * @param <int> $x
     * @param <int> $y
     */
    function getJSONIsland($x = 0, $y = 0)
    {
        $x = floor($x);
        $y = floor($y);

        echo '{"request":{"x":'.$x.',"y":'.$y.'},"data":[]}';
    }

    /**
     * Все острова
     * @param <int> $xmin
     * @param <int> $xmax
     * @param <int> $ymin
     * @param <int> $ymax
     */
    function getJSONArea($xmin = 0, $xmax = 15, $ymin = 0, $ymax = 15)
    {
        $data = '{"request":{"x_min":'.$xmin.',"x_max":'.$xmax.',"y_min":'.$ymin.',"y_max":'.$ymax.'},"data":{';

        for ($i = $xmin; $i <= $xmax; $i++)
        {
            $query_x = $this->db->query('SELECT * FROM '.$this->session->userdata('universe').'_islands WHERE x='.$i.' and y>'.$ymin.' and y<'.$ymax);
                $data .= '"'.$i.'":{';
                $j = 1;
                foreach ($query_x->result() as $island)
                {
                    $towns = 0;
                    for ($p = 0; $p <= 15; $p++)
                    {
                        $parametr = 'city'.$p;
                        if ($island->$parametr > 0){ $towns = $towns + 1; }
                    }
                    $data .= '"'.$island->y.'":["'.$island->id.'","'.$island->name.'","'.$island->trade_resource.'","'.$island->wonder.'","0","'.$island->type.'","0","'.$towns.'"]';
                    $data .= ($j == $query_x->num_rows) ? '' : ',' ;
                    $j = $j + 1;
                }
                $data .= ($i == $xmax) ? '}' : '},' ;
        }
        $data .= '}}';
        echo $data;
    }

    function army($id = 0)
    {
        $position = $this->Data_Model->get_position(5, $this->Player_Model->now_town);
        if (($this->Player_Model->now_town->build_line == '' or $this->Player_Model->build_line[$this->Player_Model->town_id][0]['type'] != 5) and
           (strlen($this->Player_Model->armys[$this->Player_Model->town_id]->army_line) <= $this->config->item('army_queue_size')*4) )
        {
            if ($position > 0 and $position == $id)
            {
                $all_cost['wood'] = 0;
                $all_cost['wine'] = 0;
                $all_cost['crystal'] = 0;
                $all_cost['sulfur'] = 0;
                $all_cost['peoples'] = 0;
                //$all_cost['gold'] = 0;
                $army_line = $this->Player_Model->armys[$this->Player_Model->town_id]->army_line;
                $army_start = ($this->Player_Model->armys[$this->Player_Model->town_id]->army_start > 0) ? $this->Player_Model->armys[$this->Player_Model->town_id]->army_start : time();
                // Обрабатываем данные
                for ($i = 1; $i <= 14; $i++)
                {
                    $class = $this->Data_Model->army_class_by_type($i);
                    $$class = (isset($_POST[$i])) ? floor($_POST[$i]) : 0 ;
                    $cost = $this->Data_Model->army_cost_by_type($i, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->town_id]);
                    $all_cost['wood'] = $all_cost['wood'] + $cost['wood']*$$class;
                    $all_cost['wine'] = $all_cost['wine'] + $cost['wine']*$$class;
                    $all_cost['crystal'] = $all_cost['crystal'] + $cost['crystal']*$$class;
                    $all_cost['sulfur'] = $all_cost['sulfur'] + $cost['sulfur']*$$class;
                    $all_cost['peoples'] = $all_cost['peoples'] + $cost['peoples']*$$class;
                    if ($$class > 0)
                    {
                        if ($army_line != '')
                        {
                            $army_line .= ';';
                        }
                        $army_line .= $i.','.$$class;
                    }
                }
                // Вычисляем остаток
                $wood = $this->Player_Model->now_town->wood - $all_cost['wood'];
                $wine = $this->Player_Model->now_town->wine - $all_cost['wine'];
                $crystal = $this->Player_Model->now_town->crystal - $all_cost['crystal'];
                $sulfur = $this->Player_Model->now_town->sulfur - $all_cost['sulfur'];
                $peoples = $this->Player_Model->now_town->peoples - $all_cost['peoples'];
                // Если хватает ресурсов
                if ($wood >= 0 and $wine >= 0 and $crystal >= 0 and $sulfur >= 0 and $peoples >= 0)
                {
                    // обновляем город
                        $this->db->set('wood', $wood);
                        $this->db->set('wine', $wine);
                        $this->db->set('crystal', $crystal);
                        $this->db->set('sulfur', $sulfur);
                        $this->db->set('peoples', $peoples);
                        $this->db->where(array('id' => $this->Player_Model->town_id));
                        $this->db->update($this->session->userdata('universe').'_towns');
                    // обновляем армию
                        $this->db->set('army_line', $army_line);
                        $this->db->set('army_start', $army_start);
                        $this->db->where(array('city' => $this->Player_Model->town_id));
                        $this->db->update($this->session->userdata('universe').'_army');
                    // Обучение - найм копейщиков
                    if ($this->Player_Model->user->tutorial <= 10)
                    {
                        $this->tutorials('set', 11);
                    }
                }
            }
        }
        redirect($this->config->item('base_url').'game/barracks/'.$id.'/', 'refresh');
    }

    function fleet($id = 0)
    {
        $position = $this->Data_Model->get_position(4, $this->Player_Model->now_town);
        if (($this->Player_Model->now_town->build_line == '' or $this->Player_Model->build_line[$this->Player_Model->town_id][0]['type'] != 4) and
           (strlen($this->Player_Model->armys[$this->Player_Model->town_id]->ships_line) <= $this->config->item('army_queue_size')*4) )
        {
            if ($position > 0 and $position == $id)
            {
                $all_cost['wood'] = 0;
                $all_cost['wine'] = 0;
                $all_cost['crystal'] = 0;
                $all_cost['sulfur'] = 0;
                $all_cost['peoples'] = 0;
                //$all_cost['gold'] = 0;
                $army_line = $this->Player_Model->armys[$this->Player_Model->town_id]->ships_line;
                $army_start = ($this->Player_Model->armys[$this->Player_Model->town_id]->ships_start > 0) ? $this->Player_Model->armys[$this->Player_Model->town_id]->ships_start : time();
                // Обрабатываем данные
                for ($i = 16; $i <= 22; $i++)
                {
                    $class = $this->Data_Model->army_class_by_type($i);
                    $$class = (isset($_POST[$i])) ? floor($_POST[$i]) : 0 ;
                    $cost = $this->Data_Model->army_cost_by_type($i, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->town_id]);
                    $all_cost['wood'] = $all_cost['wood'] + $cost['wood']*$$class;
                    $all_cost['wine'] = $all_cost['wine'] + $cost['wine']*$$class;
                    $all_cost['crystal'] = $all_cost['crystal'] + $cost['crystal']*$$class;
                    $all_cost['sulfur'] = $all_cost['sulfur'] + $cost['sulfur']*$$class;
                    $all_cost['peoples'] = $all_cost['peoples'] + $cost['peoples']*$$class;
                    if ($$class > 0)
                    {
                        if ($army_line != '')
                        {
                            $army_line .= ';';
                        }
                        $army_line .= $i.','.$$class;
                    }
                }
                // Вычисляем остаток
                $wood = $this->Player_Model->now_town->wood - $all_cost['wood'];
                $wine = $this->Player_Model->now_town->wine - $all_cost['wine'];
                $crystal = $this->Player_Model->now_town->crystal - $all_cost['crystal'];
                $sulfur = $this->Player_Model->now_town->sulfur - $all_cost['sulfur'];
                $peoples = $this->Player_Model->now_town->peoples - $all_cost['peoples'];
                // Если хватает ресурсов
                if ($wood >= 0 and $wine >= 0 and $crystal >= 0 and $sulfur >= 0 and $peoples >= 0)
                {
                    // обновляем город
                        $this->db->set('wood', $wood);
                        $this->db->set('wine', $wine);
                        $this->db->set('crystal', $crystal);
                        $this->db->set('sulfur', $sulfur);
                        $this->db->set('peoples', $peoples);
                        $this->db->where(array('id' => $this->Player_Model->town_id));
                        $this->db->update($this->session->userdata('universe').'_towns');
                    // обновляем армию
                        $this->db->set('ships_line', $army_line);
                        $this->db->set('ships_start', $army_start);
                        $this->db->where(array('city' => $this->Player_Model->town_id));
                        $this->db->update($this->session->userdata('universe').'_army');
                }
            }
        }
        redirect($this->config->item('base_url').'game/shipyard/'.$id.'/', 'refresh');
    }

    function armyEdit($type = '')
    {
        $peoples_army = 0;
        for ($i = 1; $i <= 22; $i++)
        {
                $class = $this->Data_Model->army_class_by_type($i);
                $$class = (isset($_POST[$i])) ? floor($_POST[$i]) : 0 ;
                $cost = $this->Data_Model->army_cost_by_type($i, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->town_id]);
                if ($this->Player_Model->armys[$this->Player_Model->town_id]->$class >= $$class)
                {
                    $peoples_army = $peoples_army + ($$class*$cost['peoples']);
                    $this->Player_Model->armys[$this->Player_Model->town_id]->$class = $this->Player_Model->armys[$this->Player_Model->town_id]->$class - $$class;
                }
                $this->db->set($class, $this->Player_Model->armys[$this->Player_Model->town_id]->$class);
        }
        $this->db->where(array('city' => $this->Player_Model->town_id));
        $this->db->update($this->session->userdata('universe').'_army');
        $this->Player_Model->now_town->peoples  = $this->Player_Model->now_town->peoples + $peoples_army;
        // Обновляем жителей
        $this->db->set('peoples', $this->Player_Model->now_town->peoples);
        $this->db->where(array('id' => $this->Player_Model->town_id));
        $this->db->update($this->session->userdata('universe').'_towns');
        redirect($this->config->item('base_url').'game/'.$type.'/', 'refresh');
    }

    function abortUnits($position = 0)
    {
        if($this->Player_Model->armys[$this->Player_Model->town]->army_line != '')
        {
                // обновляем армию
                $this->db->set('army_line', '');
                $this->db->set('army_start', 0);
                $this->db->where(array('city' => $this->Player_Model->town_id));
                $this->db->update($this->session->userdata('universe').'_army');
        }
        redirect($this->config->item('base_url').'game/barracks/'.$position.'/', 'refresh');
    }

    function abortShips($position = 0)
    {
        if($this->Player_Model->armys[$this->Player_Model->town]->ships_line != '')
        {
                // обновляем армию
                $this->db->set('ships_line', '');
                $this->db->set('ships_start', 0);
                $this->db->where(array('city' => $this->Player_Model->town_id));
                $this->db->update($this->session->userdata('universe').'_army');
        }
        redirect($this->config->item('base_url').'game/shipyard/'.$position.'/', 'refresh');
    }

    function abortBuildings($town = 0)
    {
        $id = -1;
        for ($i = 0; $i < SizeOf($this->Player_Model->towns); $i++)
        {
            if ($this->Player_Model->towns[$i]->id == $town) { $id = $i; }
        }
        if($id >= 0 and $this->Player_Model->towns[$id]->build_line != '')
        {
                $this->db->set('build_line', '');
                $this->db->set('build_start', 0);
                $this->db->where(array('id' => $this->Player_Model->town_id));
                $this->db->update($this->session->userdata('universe').'_towns');
        }
        redirect($this->config->item('base_url').'game/city/'.$town.'/', 'refresh');
    }

    function premium($type = '')
    {
        $cost = $this->Data_Model->premium_cost($type);
        if ($this->Player_Model->user->ambrosy >= $cost)
        {
            switch($type)
            {
                case 'account': $this->db->set('premium_account', time()+604800); break;
                case 'wood': $this->db->set('premium_wood', time()+604800); break;
                case 'wine': $this->db->set('premium_wine', time()+604800); break;
                case 'marble': $this->db->set('premium_marble', time()+604800); break;
                case 'crystal': $this->db->set('premium_crystal', time()+604800); break;
                case 'sulfur': $this->db->set('premium_sulfur', time()+604800); break;
                case 'capacity': $this->db->set('premium_capacity', time()+604800); break;
            }
            $this->db->set('ambrosy', $this->Player_Model->user->ambrosy - $cost);
            $this->db->where(array('id' => $this->Player_Model->user->id));
            $this->db->update($this->session->userdata('universe').'_users');
        }
        redirect($this->config->item('base_url').'game/premium/', 'refresh');
    }

    function options($type = '')
    {
        switch($type)
        {
            case 'user':
                if (isset($_POST['name']))
                {
                    $login = strip_tags($_POST['name']);
                    if ($login != $this->Player_Model->user->login)
                    {
                        $query = $this->db->get_where($this->session->userdata('universe').'_users', array('login' => $login));
                        // Если такого игрока нету
                        if ($query->num_rows == 0)
                        {
                            $this->db->set('login', $login);
                            $this->db->where(array('id' => $this->Player_Model->user->id));
                            $this->db->update($this->session->userdata('universe').'_users');
                        }
                        else
                        {
                            $this->session->set_flashdata(array('options_error' => 'Ошибка!'));
                            $this->session->set_flashdata(array('options_error_login' => 'Имя '.$login.' уже занято.'));
                        }
                    }
                }
                if (isset($_POST['oldPassword']) and isset($_POST['newPassword']) and isset($_POST['newPasswordConfirm']))
                {
                    $old = md5(strip_tags($_POST['oldPassword']));
                    $new = md5(strip_tags($_POST['newPassword']));
                    $new2 = md5(strip_tags($_POST['newPasswordConfirm']));
                    if ($old != $new and $old != '' and $new != '')
                    {
                        if ($this->Player_Model->user->password == $old)
                        {
                            if ($new == $new2)
                            {
                                $this->db->set('password', $new);
                                $this->db->where(array('id' => $this->Player_Model->user->id));
                                $this->db->update($this->session->userdata('universe').'_users');
                            }
                            else
                            {
                                $this->session->set_flashdata(array('options_error' => 'Ошибка!'));
                                $this->session->set_flashdata(array('options_error_login' => 'Неверный пароль!'));
                            }
                        }
                        else
                        {
                            $this->session->set_flashdata(array('options_error' => 'Ошибка!'));
                            $this->session->set_flashdata(array('options_error_login' => 'Неверное имя или пароль.'));
                        }
                    }
                }
                if (isset($_POST['citySelectOptions']))
                {
                    $city_select = floor($_POST['citySelectOptions']);
                    if ($city_select != $this->Player_Model->user->options_select and $city_select >=0 and $city_select <= 2)
                    {
                        $this->db->set('options_select', $city_select);
                        $this->db->where(array('id' => $this->Player_Model->user->id));
                        $this->db->update($this->session->userdata('universe').'_users');
                    }
                }
                if (isset($_POST['tutorialOptions']))
                {
                    if ($this->Player_Model->user->tutorial < 999 and $_POST['tutorialOptions'] == -2)
                    {
                        $this->db->set('tutorial', 999);
                        $this->db->where(array('id' => $this->Player_Model->user->id));
                        $this->db->update($this->session->userdata('universe').'_users');
                    }
                }
            break;
            case 'validationEmail':
                $this->load->library('email');
                $this->load->helper('email');
                $config['mailtype'] = 'html';               // Тип письма text или html
                $this->email->initialize($config);
                if ($this->config->item('game_email'))
                {
                                        $message = '
                                            <html>
                                            <body>
                                             <p>Привет '.$this->Player_Model->user->login.', <br>
                                             <br>Вы решили создать империю в мире Икариам '.$this->session->userdata('universe').'!<br>
                                             <br>Нажмите на ссылку, чтобы подтвердить Ваш аккаунт:<br>
                                             <br><a href="'.$this->config->item('base_url').'main/validate/'.$this->session->userdata('universe').'/'.$this->Player_Model->user->register_key.'/" target="_blank">'.$this->config->item('base_url').'main/validate/'.$this->session->userdata('universe').'/'.$this->Player_Model->user->register_key.'</a><br>
                                             <br>Ваша информация для доступа:
                                             <br>Имя игрока: '.$this->Player_Model->user->login.'<br>Пароль: ***
                                             <br>Сервер: '.$this->session->userdata('universe').'<br>
                                             <br>Если Вам понадобится помощь, то Вы сможете найти ее на форуме Икариам ('.$this->config->item('forum_url').').<br><br>Удачи в игре,<br>Ваша команда Икариам.</p>
                                            </body>
                                            </html>';
                    $this->email->from($this->config->item('email_from'), 'Гермес');
                    $this->email->to($this->Player_Model->user->email);
                    $this->email->subject('Ваша активация для Икариам!');
                    $this->email->message($message);
                    $this->email->send();
                 }
            break;
        }
        
         redirect('/game/options/', 'refresh');
    }

    function tavern($position = 0)
    {
        $position = floor($position);
        if(isset($_POST['amount']))
        {
            $type_text = 'pos'.$position.'_type';
            $level_text = 'pos'.$position.'_level';
            if ($this->Player_Model->now_town->$type_text == 8 and $this->Player_Model->now_town->$level_text >= floor($_POST['amount']))
            {
                $this->db->set('tavern_wine', floor($_POST['amount']));
                $this->db->where(array('id' => $this->Player_Model->town_id));
                $this->db->update($this->session->userdata('universe').'_towns');
            }
        }
        redirect('/game/tavern/'.$position.'/', 'refresh');
    }

    function transporter($position = 0)
    {
        $cost = $this->Data_Model->transport_cost_by_count($this->Player_Model->all_transports);
        if ($cost > 0 and $this->Player_Model->user->gold >= $cost)
        {
            $this->Player_Model->user->gold = $this->Player_Model->user->gold - $cost;
            $this->Player_Model->user->transports++;
            $this->Player_Model->all_transports++;
            $this->db->set('gold', $this->Player_Model->user->gold);
            $this->db->set('transports', $this->Player_Model->user->transports);
            $this->db->where(array('id' => $this->Player_Model->user->id));
            $this->db->update($this->session->userdata('universe').'_users');
        }
        redirect('/game/port/'.$position.'/', 'refresh');
    }

    function saveAvatarNotes()
    {
        $notes = strip_tags($_POST['notes']);
        if (strlen($notes <= $this->config->item('notes_default')) or (strlen($notes <= $this->config->item('notes_premium') and $this->Player_Model->user->premium_account > 0)))
        {
            $this->db->set('text', $notes);
            $this->db->where(array('user' => $this->Player_Model->user->id));
            $this->db->update($this->session->userdata('universe').'_notes');
        }
    }

    function transport($island = 0, $town = 0)
    {
        $island = floor($island);
        $town = floor($town);
        if ($this->Player_Model->now_town->actions > 0)
        {
            if ($island > 0 and $town >= 0)
            {
                $this->Data_Model->Load_Town($town);
                $this->load->model('Island_Model');
                $this->Island_Model->Load_Island($island);
                // Получаем данные
                $cargo_wood = isset($_POST['cargo_resource']) ? $_POST['cargo_resource'] : 0;
                $cargo_wine = isset($_POST['cargo_tradegood1']) ? $_POST['cargo_tradegood1'] : 0;
                $cargo_marble = isset($_POST['cargo_tradegood2']) ? $_POST['cargo_tradegood2'] : 0;
                $cargo_crystal = isset($_POST['cargo_tradegood3']) ? $_POST['cargo_tradegood3'] : 0;
                $cargo_sulfur = isset($_POST['cargo_tradegood4']) ? $_POST['cargo_tradegood4'] : 0;
                $transporters = isset($_POST['transporters']) ? $_POST['transporters'] : 0;
                // Подсчитываем ресурсы
                $wood = $this->Player_Model->now_town->wood - $cargo_wood;
                $wine = $this->Player_Model->now_town->wine - $cargo_wine;
                $marble = $this->Player_Model->now_town->marble - $cargo_marble;
                $crystal = $this->Player_Model->now_town->crystal - $cargo_crystal;
                $sulfur = $this->Player_Model->now_town->sulfur - $cargo_sulfur;
                $transports = $this->Player_Model->user->transports - $transporters;
                if(isset($this->Data_Model->temp_towns_db[$town]) and ($this->Player_Model->user->transports >= $transporters) and ($wood >= 0) and ($wine >= 0) and ($crystal >= 0) and ($sulfur >= 0) and ($transports >= 0) and ($transporters*$this->config->item('transport_capacity') >= $cargo_wood + $cargo_wine + $cargo_marble + $cargo_crystal + $cargo_sulfur))
                {
                    // Вычитаем ресурсы
                    $this->db->set('wood', $wood);
                    $this->db->set('wine', $wine);
                    $this->db->set('marble', $marble);
                    $this->db->set('crystal', $crystal);
                    $this->db->set('sulfur', $sulfur);
                    $this->db->set('actions', $this->Player_Model->now_town->actions - 1);
                    $this->db->where(array('id' => $this->Player_Model->now_town->id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                    $this->db->set('transports', $transports);
                    $this->db->where(array('id' => $this->Player_Model->user->id));
                    $this->db->update($this->session->userdata('universe').'_users');
                    // Добавляем миссию
                    $this->db->insert($this->session->userdata('universe').'_missions', array('user' => $this->Player_Model->user->id, 'from' => $this->Player_Model->now_town->id, 'to' => $town, 'loading_from_start' => time(), 'mission_type' => 2, 'wood' => $cargo_wood, 'wine' => $cargo_wine, 'marble' => $cargo_marble, 'crystal' => $cargo_crystal, 'sulfur' => $cargo_sulfur, 'ship_transport' => $transporters));
                }
            }
        }
        else
        {
            $this->Player_Model->Game_Error('Недостаточно баллов действий!');
        }
        redirect('/game/port/', 'refresh');
    }

    function colonize($id = 0, $position = -1)
    {
        $id = floor($id);
        $position = floor($position);
        if ($this->Player_Model->now_town->actions > 0)
        {
            if ($id > 0 and $position >= 0)
            {
                $this->load->model('Island_Model');
                $this->Island_Model->Load_Island($id);
                if(isset($_POST['action']))
                {
                    $city_text = 'city'.$position;
                        if($_POST['action'] == 'Переместить' and isset($this->Player_Model->towns[$_POST['cityId']]) and $this->Player_Model->user->ambrosy >= 200)
                        {
                            $now_position = -1;
                            for ($i = 0; $i <= 15; $i++)
                            {
                                $city_now = 'city'.$i;
                                if ($this->Player_Model->islands[$this->Player_Model->towns[$_POST['cityId']]->island]->$city_now == $_POST['cityId']){$now_position = $i;}
                            }
                            if($this->Island_Model->island->$city_text == 0 and $now_position >= 0)
                            {
                                // Удаляем старую отметку
                                $this->db->set('city'.$now_position, 0);
                                $this->db->where(array('id' => $this->Player_Model->towns[$_POST['cityId']]->island));
                                $this->db->update($this->session->userdata('universe').'_islands');
                                // Пишем новую отметку
                                $this->db->set('city'.$position, $_POST['cityId']);
                                $this->db->where(array('id' => $id));
                                $this->db->update($this->session->userdata('universe').'_islands');
                                // Пишем новый остров в городе
                                $this->db->set('island', $id);
                                $this->db->set('position', $position);
                                $this->db->where(array('id' => $_POST['cityId']));
                                $this->db->update($this->session->userdata('universe').'_towns');
                                // Забираем амброзию
                                $this->db->set('ambrosy', $this->Player_Model->user->ambrosy-200);
                                $this->db->where(array('id' => $this->Player_Model->user->id));
                                $this->db->update($this->session->userdata('universe').'_users');
                            }
                        }
                        else
                        {
                            if(SizeOf($this->Player_Model->towns)-1 < $this->Player_Model->levels[$this->Player_Model->capital_id][10])
                            {
                                $sendresource = floor($_POST['sendresource']);
                                $sendwine = floor($_POST['sendwine']);
                                $sendmarble = floor($_POST['sendmarble']);
                                $sendcrystal = floor($_POST['sendcrystal']);
                                $sendsulfur = floor($_POST['sendsulfur']);
                                $transporters = floor($_POST['transporters']);
                                $wood = $this->Player_Model->now_town->wood - $sendresource - 1250;
                                $wine = $this->Player_Model->now_town->wine - $sendwine;
                                $marble = $this->Player_Model->now_town->marble - $sendmarble;
                                $crystal = $this->Player_Model->now_town->crystal - $sendcrystal;
                                $sulfur = $this->Player_Model->now_town->sulfur - $sendsulfur;
                                $peoples = $this->Player_Model->now_town->peoples - 40;
                                $gold = $this->Player_Model->user->gold - 9000;
                                $transports = $this->Player_Model->user->transports - $transporters;
                                if(($this->Player_Model->user->transports >= $transporters) and ($wood >= 0) and ($wine >= 0) and ($crystal >= 0) and ($sulfur >= 0) and ($peoples >= 0) and ($gold >= 0) and ($transports >= 0) and ($transporters*$this->config->item('transport_capacity') >= $sendresource + $sendwine + $sendmarble + $sendcrystal + $sendsulfur + 1250 + 40))
                                {
                                    if($this->Island_Model->island->$city_text == 0)
                                    {
                                        // Добавляем город
                                        $this->db->insert($this->session->userdata('universe').'_towns', array('user' => $this->Player_Model->user->id, 'island' => $this->Island_Model->island->id, 'position' => $position, 'pos0_level' => 0));
                                        // Находим город в базе
                                        $town_query = $this->db->get_where($this->session->userdata('universe').'_towns', array('island' => $this->Island_Model->island->id, 'position' => $position));
                                        $town = $town_query->row();
                                        // Обновляем остров
                                        $this->db->set('city'.$position, $town->id);
                                        $this->db->where(array('id' => $this->Island_Model->island->id));
                                        $this->db->update($this->session->userdata('universe').'_islands');
                                        // Вычитаем ресурсы
                                        $this->db->set('wood', $wood);
                                        $this->db->set('wine', $wine);
                                        $this->db->set('marble', $marble);
                                        $this->db->set('crystal', $crystal);
                                        $this->db->set('sulfur', $sulfur);
                                        $this->db->set('peoples', $peoples);
                                        $this->db->set('actions', $this->Player_Model->now_town->actions - 1);
                                        $this->db->where(array('id' => $this->Player_Model->now_town->id));
                                        $this->db->update($this->session->userdata('universe').'_towns');
                                        $this->db->set('gold', $gold);
                                        $this->db->set('transports', $transports);
                                        $this->db->where(array('id' => $this->Player_Model->user->id));
                                        $this->db->update($this->session->userdata('universe').'_users');
                                        // Добавляем миссию
                                        $this->db->insert($this->session->userdata('universe').'_missions', array('user' => $this->Player_Model->user->id, 'from' => $this->Player_Model->now_town->id, 'to' => $town->id, 'loading_from_start' => time(), 'mission_type' => 1, 'wood' => $sendresource+1250, 'wine' => $sendwine, 'marble' => $sendmarble, 'crystal' => $sendcrystal, 'sulfur' => $sendsulfur, 'gold' => 9000, 'peoples' => 40, 'ship_transport' => $transporters));
                                    }
                                }
                            }
                        }
                }
            }
        }
        else
        {
            $this->Player_Model->Game_Error('Недостаточно баллов действий!');
        }
        redirect('/game/island/'.$id.'/', 'refresh');
    }

    function abortFleet($mission = 0, $position = 0, $redirect = 'port')
    {
        if (isset($this->Player_Model->missions[$mission]))
        {
            if ($this->Player_Model->missions[$mission]->mission_start == 0)
            {
                // Колонизация
                // Если еще не погрузили удаляем город и возвращаем ресурсы
                if($this->Player_Model->missions[$mission]->mission_type == 1)
                {
                    // Удаляем город
                    $town_query = $this->db->get_where($this->session->userdata('universe').'_towns', array('id' => $this->Player_Model->missions[$mission]->to));
                    $town = $town_query->row();
                    $this->db->set('city'.$town->position, 0);
                    $this->db->where(array('id' => $town->island));
                    $this->db->update($this->session->userdata('universe').'_islands');
                    $this->db->query('DELETE FROM '.$this->session->userdata('universe').'_towns where `id`="'.$this->Player_Model->missions[$mission]->to.'"');
                }
                    // возвращаем ресурсы
                    $this->db->set('wood', $this->Player_Model->towns[$this->Player_Model->missions[$mission]->from]->wood + $this->Player_Model->missions[$mission]->wood);
                    $this->db->set('wine', $this->Player_Model->towns[$this->Player_Model->missions[$mission]->from]->wine + $this->Player_Model->missions[$mission]->wine);
                    $this->db->set('marble', $this->Player_Model->towns[$this->Player_Model->missions[$mission]->from]->marble + $this->Player_Model->missions[$mission]->marble);
                    $this->db->set('crystal', $this->Player_Model->towns[$this->Player_Model->missions[$mission]->from]->crystal + $this->Player_Model->missions[$mission]->crystal);
                    $this->db->set('sulfur', $this->Player_Model->towns[$this->Player_Model->missions[$mission]->from]->sulfur + $this->Player_Model->missions[$mission]->sulfur);
                    $this->db->set('peoples', $this->Player_Model->towns[$this->Player_Model->missions[$mission]->from]->peoples + $this->Player_Model->missions[$mission]->peoples);
                    $this->db->where(array('id' => $this->Player_Model->missions[$mission]->from));
                    $this->db->update($this->session->userdata('universe').'_towns');
                    $this->db->set('gold', $this->Player_Model->user->gold + $this->Player_Model->missions[$mission]->gold);
                    $this->db->set('transports', $this->Player_Model->user->transports + $this->Player_Model->missions[$mission]->ship_transport);
                    $this->db->where(array('id' => $this->Player_Model->user->id));
                    $this->db->update($this->session->userdata('universe').'_users');
                    $this->db->query('DELETE FROM '.$this->session->userdata('universe').'_missions where `id`="'.$this->Player_Model->missions[$mission]->id.'"');
            }
            else
            {
                // Если погрузили просто разворачиваем
                if($this->Player_Model->missions[$mission]->return_start == 0)
                {
                    $cost = $this->Data_Model->army_cost_by_type(23, $this->Player_Model->research, $this->Player_Model->levels[$this->Player_Model->town_id]);
                    $x1 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$this->Player_Model->missions[$mission]->from]->island]->x;
                    $x2 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$this->Player_Model->missions[$mission]->to]->island]->x;
                    $y1 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$this->Player_Model->missions[$mission]->from]->island]->y;
                    $y2 = $this->Data_Model->temp_islands_db[$this->Data_Model->temp_towns_db[$this->Player_Model->missions[$mission]->to]->island]->y;
                    $time = $this->Data_Model->time_by_coords($x1,$x2,$y1,$y2,$cost['speed']);
                    $elapsed = time() - $this->Player_Model->missions[$mission]->mission_start;
                    $ostalos = ($time - $elapsed >= 0) ? $time - $elapsed : 0;
                    $return_time = $time - $elapsed;
                    $this->Player_Model->missions[$mission]->percent = 1 - $return_time/$time;
                    $this->db->set('percent', $this->Player_Model->missions[$mission]->percent);
                    $this->db->set('return_start', time());
                    $this->db->where(array('id' => $this->Player_Model->missions[$mission]->id));
                    $this->db->update($this->session->userdata('universe').'_missions');
                }
            }
        }
        redirect('/game/'.$redirect.'/'.$position.'/', 'refresh');
    }

    function leaveConstructionList($id = 1)
    {
        if(isset($this->Player_Model->build_line[$this->Player_Model->town_id][$id]) and $id > 0)
        {
            if (SizeOf($this->Player_Model->build_line[$this->Player_Model->town_id]) > 1)
            for ($i = 0; $i < SizeOf($this->Player_Model->build_line[$this->Player_Model->town_id]); $i++)
            {
                if ($i != $id)
                {
                    $building = array($this->Player_Model->build_line[$this->Player_Model->town_id][$i]['position'], $this->Player_Model->build_line[$this->Player_Model->town_id][$i]['type']);
                    $building_line[] = implode(",", $building);
                }
            }
            $buildings_line = implode(";", $building_line);
            $this->db->set('build_line', $buildings_line);
            $this->db->where(array('id' => $this->Player_Model->town_id));
            $this->db->update($this->session->userdata('universe').'_towns');
        }
        redirect('/game/city/', 'refresh');
    }

    function branchOffice($position)
    {
        if (isset($_POST['type']) and isset($_POST['searchResource']))
        {
            $type = ($_POST['type'] <= 1) ? floor($_POST['type']) : 0;
            switch($_POST['searchResource'])
            {
                case 1: $resource = 1; break;
                case 2: $resource = 2; break;
                case 3: $resource = 3; break;
                case 4: $resource = 4; break;
                default: $resource = 0; break;
            }
            $this->db->set('branch_search_type', $type);
            $this->db->set('branch_search_resource', $resource);
            $this->db->set('branch_search_radius', floor($_POST['range']));
            $this->db->where(array('id' => $this->Player_Model->town_id));
            $this->db->update($this->session->userdata('universe').'_towns');
        }
        if(isset($_POST['resource']) and isset($_POST['tradegood1']) and isset($_POST['tradegood2']) and isset($_POST['tradegood3']) and isset($_POST['tradegood4']))
        {
            $wood_count = floor($_POST['resource']);
            $wine_count = floor($_POST['tradegood1']);
            $marble_count = floor($_POST['tradegood2']);
            $crystal_count = floor($_POST['tradegood3']);
            $sulfur_count = floor($_POST['tradegood4']);
            $gold_wood = floor($_POST['resourcePrice']);
            $gold_wine = floor($_POST['tradegood1Price']);
            $gold_marble = floor($_POST['tradegood2Price']);
            $gold_crystal = floor($_POST['tradegood3Price']);
            $gold_sulfur = floor($_POST['tradegood4Price']);
            $capacity = $this->Data_Model->branchOffice_capacity_by_level($this->Player_Model->levels[$this->Player_Model->town_id][12]);
            $all_trade_resources = 0;
            if($_POST['resourceTradeType'] == 1){ $all_trade_resources = $all_trade_resources + $wood_count; }
            if($_POST['tradegood1TradeType'] == 1){ $all_trade_resources = $all_trade_resources + $wine_count; }
            if($_POST['tradegood2TradeType'] == 1){ $all_trade_resources = $all_trade_resources + $marble_count; }
            if($_POST['tradegood3TradeType'] == 1){ $all_trade_resources = $all_trade_resources + $crystal_count; }
            if($_POST['tradegood4TradeType'] == 1){ $all_trade_resources = $all_trade_resources + $sulfur_count; }
            for($i = 0; $i <= 4; $i++)
            {
                $resource_name = $this->Data_Model->resource_class_by_type($i);
                $branch_type = 'branch_trade_'.$resource_name.'_type';
                $branch_count = 'branch_trade_'.$resource_name.'_count';
                $branch_cost = 'branch_trade_'.$resource_name.'_cost';
                switch($i)
                {
                    case 1: $post_name = 'tradegood1'; $count = $wine_count; $gold = $gold_wine; break;
                    case 2: $post_name = 'tradegood2'; $count = $marble_count; $gold = $gold_marble; break;
                    case 3: $post_name = 'tradegood3'; $count = $crystal_count; $gold = $gold_crystal; break;
                    case 4: $post_name = 'tradegood4'; $count = $sulfur_count; $gold = $gold_sulfur; break;
                    default: $post_name = 'resource'; $count = $wood_count; $gold = $gold_wood; break;
                }
                if ($count == 0){ $gold = 0; }
                if ($gold == 0){ $count = 0; }
                if ($_POST[$post_name.'TradeType'] == 1 and $all_trade_resources <= $capacity)
                {
                    if($this->Player_Model->now_town->$branch_type == 1){
                        $this->Player_Model->now_town->$resource_name = $this->Player_Model->now_town->$resource_name + $this->Player_Model->now_town->$branch_count - $count;
                    }else{
                        $this->Player_Model->user->gold = $this->Player_Model->user->gold + ($this->Player_Model->now_town->$branch_count*$this->Player_Model->now_town->$branch_cost);
                        $this->Player_Model->now_town->$resource_name = $this->Player_Model->now_town->$resource_name  - $count;
                    }
                    $this->Player_Model->now_town->$branch_type = floor($_POST[$post_name.'TradeType']);
                    $this->Player_Model->now_town->$branch_count = $count;
                    $this->Player_Model->now_town->$branch_cost = $gold;
                }
                elseif ($_POST[$post_name.'TradeType'] == 0)
                {
                    if($this->Player_Model->now_town->$branch_type == 0){
                        $this->Player_Model->user->gold = $this->Player_Model->user->gold + ($this->Player_Model->now_town->$branch_count*$this->Player_Model->now_town->$branch_cost) - ($gold*$count);
                    }
                    else
                    {
                        $this->Player_Model->now_town->$resource_name = $this->Player_Model->now_town->$resource_name + $this->Player_Model->now_town->$branch_count;
                        $this->Player_Model->user->gold = $this->Player_Model->user->gold - ($gold*$count);
                    }
                    $this->Player_Model->now_town->$branch_type = floor($_POST[$post_name.'TradeType']);
                    $this->Player_Model->now_town->$branch_count = $count;
                    $this->Player_Model->now_town->$branch_cost = $gold;
                }
            }
            if($this->Player_Model->user->gold >= 0 and
               $this->Player_Model->now_town->wood >= 0 and
               $this->Player_Model->now_town->wine >= 0 and
               $this->Player_Model->now_town->marble >= 0 and
               $this->Player_Model->now_town->crystal >= 0 and
               $this->Player_Model->now_town->sulfur >= 0)
            {
                for($i = 0; $i <= 4; $i++)
                {
                    $resource_name = $this->Data_Model->resource_class_by_type($i);
                    $branch_type = 'branch_trade_'.$resource_name.'_type';
                    $branch_count = 'branch_trade_'.$resource_name.'_count';
                    $branch_cost = 'branch_trade_'.$resource_name.'_cost';
                    $this->db->set($resource_name, $this->Player_Model->now_town->$resource_name);
                    $this->db->set($branch_type, $this->Player_Model->now_town->$branch_type);
                    $this->db->set($branch_count, $this->Player_Model->now_town->$branch_count);
                    $this->db->set($branch_cost, $this->Player_Model->now_town->$branch_cost);
                }
                $this->db->where(array('id' => $this->Player_Model->town_id));
                $this->db->update($this->session->userdata('universe').'_towns');
                $this->db->set('gold', $this->Player_Model->user->gold);
                $this->db->where(array('id' => $this->Player_Model->user->id));
                $this->db->update($this->session->userdata('universe').'_users');
            }
        }
        redirect('/game/branchOffice/'.$position.'/', 'refresh');
    }

    function trade($town = 0, $type = 0)
    {
        if ($this->Player_Model->now_town->actions > 0)
        {
            if ($town > 0)
            {
                // Читаем данные
                $wood_count = (isset($_POST['cargo_resource']) and floor($_POST['cargo_resource']) > 0) ? floor($_POST['cargo_resource']) : 0;
                $wine_count = (isset($_POST['cargo_tradegood1']) and floor($_POST['cargo_tradegood1']) > 0) ? floor($_POST['cargo_tradegood1']) : 0;
                $marble_count = (isset($_POST['cargo_tradegood2']) and floor($_POST['cargo_tradegood2']) > 0) ? floor($_POST['cargo_tradegood2']) : 0;
                $crystal_count = (isset($_POST['cargo_tradegood3']) and floor($_POST['cargo_tradegood3']) > 0) ? floor($_POST['cargo_tradegood3']) : 0;
                $sulfur_count = (isset($_POST['cargo_tradegood4']) and floor($_POST['cargo_tradegood4']) > 0) ? floor($_POST['cargo_tradegood4']) : 0;
                $wood_cost = (isset($_POST['resourcePrice']) and floor($_POST['resourcePrice']) > 0) ? floor($_POST['resourcePrice']) : 0;
                $wine_cost = (isset($_POST['tradegood1Price']) and floor($_POST['tradegood1Price']) > 0) ? floor($_POST['tradegood1Price']) : 0;
                $marble_cost = (isset($_POST['tradegood2Price']) and floor($_POST['tradegood2Price']) > 0) ? floor($_POST['tradegood2Price']) : 0;
                $crystal_cost = (isset($_POST['tradegood3Price']) and floor($_POST['tradegood3Price']) > 0) ? floor($_POST['tradegood3Price']) : 0;
                $sulfur_cost = (isset($_POST['tradegood4Price']) and floor($_POST['tradegood4Price']) > 0) ? floor($_POST['tradegood4Price']) : 0;
                $gold_need = floor(($wood_count*$wood_cost) + ($wine_count*$wine_cost) + ($marble_count*$marble_cost) + ($crystal_count*$crystal_cost) + ($sulfur_count*$sulfur_cost));
                $transporters = floor($_POST['transporters']);

                $transports = $this->Player_Model->user->transports - $transporters;

                $this->Data_Model->Load_Town($town);
                if(isset($this->Data_Model->temp_towns_db[$town]))
                {
                    if ($this->Player_Model->user->gold > 0 and $transports > 0)
                    {
                        if ($type == 1)
                        {
                            $this->Player_Model->user->gold = $this->Player_Model->user->gold - $gold_need;
                            if ($this->Player_Model->user->gold > 0)
                            {
                                $trade_town = $this->Data_Model->temp_towns_db[$town];
                                $this->db->set('gold', $this->Player_Model->user->gold);
                                $this->db->set('transports', $transports);
                                $this->db->where(array('id' => $this->Player_Model->user->id));
                                $this->db->update($this->session->userdata('universe').'_users');
                                $this->db->insert($this->session->userdata('universe').'_missions', array('user' => $this->Player_Model->user->id, 'from' => $this->Player_Model->now_town->id, 'to' => $town, 'loading_from_start' => time(), 'mission_start' => time(), 'mission_type' => 3, 'trade_wood_count' => $wood_count, 'trade_wine_count' => $wine_count, 'trade_marble_count' => $marble_count, 'trade_crystal_count' => $crystal_count, 'trade_sulfur_count' => $sulfur_count, 'gold' => $gold_need, 'trade_wood_cost' => $wood_cost, 'trade_wine_cost' => $wine_cost, 'trade_marble_cost' => $marble_cost, 'trade_crystal_cost' => $crystal_cost, 'trade_sulfur_cost' => $sulfur_cost, 'ship_transport' => $transporters));
                                $this->db->set('actions', $this->Player_Model->now_town->actions - 1);
                                $this->db->where(array('id' => $this->Player_Model->now_town->id));
                                $this->db->update($this->session->userdata('universe').'_towns');
                            }
                        }
                        if($type == 0)
                        {
                            $trade_town = $this->Data_Model->temp_towns_db[$town];
                            // Вычитаем остаток
                            $wood = $this->Player_Model->now_town->wood - $wood_count;
                            $wine = $this->Player_Model->now_town->wine - $wine_count;
                            $marble = $this->Player_Model->now_town->marble - $marble_count;
                            $crystal = $this->Player_Model->now_town->crystal - $crystal_count;
                            $sulfur = $this->Player_Model->now_town->sulfur - $sulfur_count;
                            if ($wood >= 0 and $wine >=0 and $marble >= 0 and $crystal >= 0 and $sulfur >=0)
                            {
                                $this->db->set('transports', $transports);
                                $this->db->where(array('id' => $this->Player_Model->user->id));
                                $this->db->update($this->session->userdata('universe').'_users');
                                $this->db->insert($this->session->userdata('universe').'_missions', array('user' => $this->Player_Model->user->id, 'from' => $this->Player_Model->now_town->id, 'to' => $town, 'loading_from_start' => time(), 'mission_type' => 4, 'wood' => $wood_count, 'wine' => $wine_count, 'marble' => $marble_count, 'crystal' => $crystal_count, 'sulfur' => $sulfur_count, 'trade_wood_cost' => $wood_cost, 'trade_wine_cost' => $wine_cost, 'trade_marble_cost' => $marble_cost, 'trade_crystal_cost' => $crystal_cost, 'trade_sulfur_cost' => $sulfur_cost, 'ship_transport' => $transporters));
                                $this->db->set('wood', $wood);
                                $this->db->set('wine', $wine);
                                $this->db->set('marble', $marble);
                                $this->db->set('crystal', $crystal);
                                $this->db->set('sulfur', $sulfur);
                                $this->db->set('actions', $this->Player_Model->now_town->actions - 1);
                                $this->db->where(array('id' => $this->Player_Model->now_town->id));
                                $this->db->update($this->session->userdata('universe').'_towns');
                            }
                        }
                    }
                }
            }
        }
        else
        {
            $this->Player_Model->Game_Error('Недостаточно баллов действий!');
        }
        redirect('/game/branchOffice/', 'refresh');
    }

}

/* End of file actions.php */
/* Location: ./system/application/controllers/actions.php */