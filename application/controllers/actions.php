<?php
/**
 * Контроллер действий
 */
class Actions extends Controller
{

    function Actions()
    {
        parent::Controller();
        $this->load->model('User_Model');
        if (!$this->session->userdata('login'))
        {
            $this->User_Model->Error('Ваша сессия истекла, войдите снова!');
        }
        else
        {
            // Загружаем пользователя
            $this->User_Model->Load_User($this->session->userdata('id'));
        }
    }

    /**
     * Переход на страницу ошибок
     * @param <string> $error
     */
    function Error($error = '')
    {
                $this->session->set_userdata(array('error' => $error));
                redirect('/game/error/', 'refresh');
    }
    
    /**
     * Обучение: Переход к следующему обучению
     * @param <string> $action
     */
    function tutorials($action, $id = 0)
    {
        $id = intval($id);
        switch($action)
        {
            // следующий этап обучения
            case 'next':
                $this->User_Model->tutorial = $this->User_Model->tutorial + 1;
                $this->db->query('UPDATE `'.$this->session->userdata('universe').'_users'.'` SET `tutorial`=`tutorial`+1 WHERE `id`="'.$this->session->userdata('id').'"');
            break;
            case 'set':
                $this->User_Model->tutorial = $id;
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
        $position = intval($position);
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        if ($this->Town_Model->buildings[$position] != false){
            $this->build($position, $this->Town_Model->buildings[$position]['type'], $this->Data_Model->building_class_by_type($this->Town_Model->buildings[$position]['type']));
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
        $position = intval($position);
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        if ((($position == 0 and $this->Town_Model->buildings[$position]['level'] > 1) or $this->Town_Model->build_line[0]['type'] == 1) or $position > 0)
        {
            $level = $this->Town_Model->buildings[$position]['level'];
            // Получаем цены
            if ($this->Town_Model->build_text != '' and $this->Town_Model->build_line[0]['position'] == $position)
            {
                $cost = $this->Data_Model->building_cost($this->Town_Model->buildings[$position]['type'],$this->Town_Model->buildings[$position]['level']);
            }
            else
            {
                $cost = $this->Data_Model->building_cost($this->Town_Model->buildings[$position]['type'],$this->Town_Model->buildings[$position]['level']-2);
                $level = ($level > 0) ? $level - 1 : $level;
            }
            $wood = $this->Town_Model->resources['wood'] + ($cost['wood']*0.9);
            $wine = $this->Town_Model->resources['wine'] + ($cost['wine']*0.9);
            $marble = $this->Town_Model->resources['marble'] + ($cost['marble']*0.9);
            $crystal = $this->Town_Model->resources['crystal'] + ($cost['crystal']*0.9);
            $sulfur = $this->Town_Model->resources['sulfur'] + ($cost['sulfur']*0.9);
            // Заносим данные в базу
            if (sizeof($this->Town_Model->build_line) > 1)
            {
                $build_line = substr($this->Town_Model->build_text, 4);
                $build_start = $this->Town_Model->build_start;
            }
            else
            {
                $build_line = '';
                $build_start = 0;
            }
            if ($build_line != '')
            {
                $do = true;
                while ($do)
                {
                    // вычитаем стоимость след. здания
                    $buildings = $this->Data_Model->load_build_line($build_line);
                    $type = $this->Town_Model->buildings[$buildings[0]['position']]['type'];
                    $level = $this->Town_Model->buildings[$buildings[0]['position']]['level'];
                    $cost = $this->Data_Model->building_cost($type, $level);
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
                        $build_line = substr($build_line, 4);
                    }
                }
            }

            if ($build_line == ''){ $build_start = 0; }

            $this->db->set('build_line', $build_line);
            $this->db->set('build_start', $build_start);
            $this->db->set('pos'.$position.'_level', $level);
            $this->db->set('pos'.$position.'_type', $this->Town_Model->buildings[$position]['type']);
            $this->db->set('wood', $wood);
            $this->db->set('wine', $wine);
            $this->db->set('marble', $marble);
            $this->db->set('crystal', $crystal);
            $this->db->set('sulfur', $sulfur);
            $this->db->where(array('id' => $this->Town_Model->id));
            $this->db->update($this->session->userdata('universe').'_towns');
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
        $id = intval($id);
        $position = intval($position);
        $redirect = strip_tags($redirect);
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        $class = $this->Data_Model->building_class_by_type($id);

        if ($class != 'buildingGround' and ($id != 13 or $this->User_Model->research->res2_13 > 0) and ($this->Town_Model->buildings[$position]['type'] == 0 or $this->Town_Model->buildings[$position]['type'] == $id))
        {
            $level = ($this->Town_Model->buildings[$position] != false ) ? $this->Town_Model->buildings[$position]['level'] : 0;
            // Получаем цены
            $cost = $this->Data_Model->building_cost($id, $level);
            // Подсчитываем остаток
            $wood = $this->Town_Model->resources['wood'] - $cost['wood'];
            $wine = $this->Town_Model->resources['wine'] - $cost['wine'];
            $marble = $this->Town_Model->resources['marble'] - $cost['marble'];
            $crystal = $this->Town_Model->resources['crystal'] - $cost['crystal'];
            $sulfur = $this->Town_Model->resources['sulfur'] - $cost['sulfur'];
            // Если остаток приемлемый
            if ($wood >= 0 and $wine >= 0 and $marble >= 0 and $crystal >= 0 and $sulfur >= 0)
            {
                if ($this->Town_Model->build_text == '')
                {
                    // Обновляем ресурсы в базе и в модели
                    $this->db->set('wood', $wood); $this->Town_Model->resources['wood'] = $wood;
                    $this->db->set('wine', $wine); $this->Town_Model->resources['wine'] = $wine;
                    $this->db->set('marble', $marble); $this->Town_Model->resources['marble'] = $marble;
                    $this->db->set('crystal', $crystal); $this->Town_Model->resources['crystal'] = $crystal;
                    $this->db->set('sulfur', $sulfur); $this->Town_Model->resources['sulfur'] = $sulfur;
                }
                // Строка текста прямо как в базе
                if ($this->Town_Model->build_text != '')
                {
                    $this->db->set('build_line', $this->Town_Model->build_text.';'.$position.','.$id);
                    $this->Town_Model->build_text = $this->Town_Model->build_text.';'.$position.','.$id;
                }
                else
                {
                    $this->db->set('build_line', $position.','.$id);
                    $this->Town_Model->build_text = $this->Town_Model->build_text.$position.','.$id;
                }
                // Устанавливаем время старта если его нету
                if ($this->Town_Model->build_start == 0)
                {
                    $this->db->set('build_start', time());
                    $this->Town_Model->build_start = time();
                }
                $this->db->where(array('id' => $this->Town_Model->id));
                $this->db->update($this->session->userdata('universe').'_towns');
                // Здание добавлено в очередь
                // Обновляем обучения если есть
                        if ($id == 3 and $this->User_Model->tutorial <= 4)
                        {
                            // Построили академию
                            $this->tutorials('set', 5);
                        }
                        if ($id == 5 and $this->User_Model->tutorial <= 8)
                        {
                            // Построили казарму
                            $this->tutorials('set', 9);
                        }
                        if ($id == 7 and $this->User_Model->tutorial <= 12)
                        {
                            // Построили стену
                            $this->tutorials('set', 13);
                        }
                        if ($id == 2 and $this->User_Model->tutorial <= 13)
                        {
                            // Построили порт
                            $this->tutorials('set', 14);
                        }
                        if ($level > 0 and  $this->User_Model->tutorial <= 15)
                        {
                            // Апгрейдили здание
                            $this->tutorials('set', 16);
                        }

            }
        }
        // Переход на страницу игры
        if ($redirect) { redirect($this->config->item('base_url').'game/'.$redirect.'/', 'refresh'); }
    }

    /**
     * Переименовать город
     */
    function rename()
    {
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        if (isset($_POST['name']) and strip_tags($_POST['name']) != '')
        {
           $this->db->set('name', strip_tags($_POST['name']));
           $this->db->where(array('id' => $this->Town_Model->id));
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
        if ($type == 'resource' and $this->User_Model->tutorial <= 2)
        {
            $this->tutorials('set', 3);
        }    
        if ($type == 'academy' and $this->User_Model->tutorial <= 6)
        {
            $this->tutorials('set', 7);
        }
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        // Рабочие
        if (isset($_POST['rw']))
        {
            $level = $this->Town_Model->island->wood_level;
            $cost = $this->Data_Model->island_cost(0, $level);
            if ($cost['workers'] >= $_POST['rw'])
            {
                $all = $this->Town_Model->peoples['workers'] + $this->Town_Model->peoples['free'];
                if ($all >= $_POST['rw'])
                {
                    $this->Town_Model->peoples['workers'] = intval($_POST['rw']);
                    $this->Town_Model->peoples['free'] = $all - intval($_POST['rw']);
                    $this->db->set('workers', $this->Town_Model->peoples['workers']);
                    $this->db->set('peoples', $this->Town_Model->peoples['free']);
                    $this->db->where(array('id' => $this->Town_Model->id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }
        // Ученые
        if (isset($_POST['s']) and $id > 0 and $this->Town_Model->already_build[3])
        {
            $max_scientists = $this->Data_Model->scientists_by_level($this->Town_Model->buildings[$id]['level']);
            if ($max_scientists >= $_POST['s'])
            {
                $all = $this->Town_Model->peoples['research'] + $this->Town_Model->peoples['free'];
                if ($all >= $_POST['s'] )
                {
                    $this->Town_Model->peoples['research'] = intval($_POST['s']);
                    $this->Town_Model->peoples['free'] = $all - intval($_POST['s']);
                    $this->db->set('scientists', $this->Town_Model->peoples['research']);
                    $this->db->set('peoples', $this->Town_Model->peoples['free']);
                    $this->db->where(array('id' => $this->Town_Model->id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                }
            }
        }
        // Возвращаемся в игру
        redirect($this->config->item('base_url').'game/'.$type.'/', 'refresh');
    }

    function resources($id = 0)
    {
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        
        $count = isset($_POST['donation']) ? intval($_POST['donation']) : 0;
        if($this->Town_Model->resources['wood'] >= $count and $count > 0 and $this->Town_Model->island->id == $id)
        {
            // Обновляем город
            $this->db->set('workers_wood', $this->Town_Model->workers_wood + $count);
            $this->db->set('wood', $this->Town_Model->resources['wood'] - $count);
            $this->db->where(array('id' => $this->Town_Model->id));
            $this->db->update($this->session->userdata('universe').'_towns');
            // Обновляем остров
            $this->db->query('UPDATE `'.$this->session->userdata('universe').'_islands'.'` SET `wood_count`=`wood_count`+'.$count.' WHERE `id`="'.$id.'"');
        }
        redirect($this->config->item('base_url').'game/resource/'.$id.'/', 'refresh');
    }

    function doResearch($way = 0, $id = 0)
    {
        $way = intval($way);
        $id = intval($id);
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        if($way > 0 and $way <= 4)
        {
            $parametr = 'res'.$way.'_'.$id;
            $data = $this->Data_Model->get_research($way,$id,$this->User_Model->research);
            if ($this->User_Model->research->points >= $data['points'])
            {
                $this->db->set('points', $this->User_Model->research->points - $data['points']);
                $this->db->set($parametr, $this->User_Model->research->$parametr + 1);
                $this->db->where(array('user' => $this->User_Model->id));
                $this->db->update($this->session->userdata('universe').'_research');
                // Благосостояние
                if($way == 2 and $id == 3)
                {
                    $this->db->set('wood', $this->Town_Model->resources['wood'] + 130);
                    $this->db->set('marble', $this->Town_Model->resources['marble'] + 130);
                    $this->db->set('wine', $this->Town_Model->resources['wine'] + 130);
                    $this->db->set('crystal', $this->Town_Model->resources['crystal'] + 130);
                    $this->db->set('sulfur', $this->Town_Model->resources['sulfur'] + 130);
                    $this->db->where(array('id' => $this->Town_Model->id));
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
        $x = intval($x);
        $y = intval($y);

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
        $xmin = intval($xmin);
        $xmax = intval($xmin);
        $ymin = intval($xmin);
        $ymax = intval($xmin);
        
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
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        $position = $this->Data_Model->get_position(5, $this->Town_Model->buildings);
        if ($this->Town_Model->army_line == '' and $position > 0 and $position == $id)
        {
            $all_cost['wood'] = 0;
            $all_cost['wine'] = 0;
            $all_cost['crystal'] = 0;
            $all_cost['sulfur'] = 0;
            $all_cost['peoples'] = 0;
            //$all_cost['gold'] = 0;
            $army_line = $this->User_Model->armys[$this->Town_Model->id]->army_line;
            $army_start = ($this->User_Model->armys[$this->Town_Model->id]->army_start > 0) ? $this->User_Model->armys[$this->Town_Model->id]->army_start : time();
            // Обрабатываем данные
            for ($i = 1; $i <= 14; $i++)
            {
                $class = $this->Data_Model->army_class_by_type($i);
                $$class = (isset($_POST[$i])) ? intval($_POST[$i]) : 0 ;
                $cost = $this->Data_Model->army_cost_by_type($i);
                $all_cost['wood'] = $all_cost['wood'] + $cost['wood']*$$class;
                $all_cost['wine'] = $all_cost['wine'] + $cost['wine']*$$class;
                $all_cost['crystal'] = $all_cost['crystal'] + $cost['crystal']*$$class;
                $all_cost['sulfur'] = $all_cost['sulfur'] + $cost['sulfur']*$$class;
                $all_cost['peoples'] = $all_cost['peoples'] + $cost['peoples']*$$class;
                //$all_cost['gold'] = $all_cost['gold'] + $cost['gold']*$$class;
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
            $wood = $this->Town_Model->resources['wood'] - $all_cost['wood'];
            $wine = $this->Town_Model->resources['wine'] - $all_cost['wine'];
            $crystal = $this->Town_Model->resources['crystal'] - $all_cost['crystal'];
            $sulfur = $this->Town_Model->resources['sulfur'] - $all_cost['sulfur'];
            $peoples = $this->Town_Model->peoples['free'] - $all_cost['peoples'];
            //$gold = $this->User_Model->gold - $all_cost['gold'];
            // Если хватает ресурсов
            if ($wood >= 0 and $wine >= 0 and $crystal >= 0 and $sulfur >= 0 and $peoples >= 0/* and $gold >= 0*/)
            {
                // обновляем город
                    $this->db->set('wood', $wood);
                    $this->db->set('wine', $wine);
                    $this->db->set('crystal', $crystal);
                    $this->db->set('sulfur', $sulfur);
                    $this->db->set('peoples', $peoples);
                    $this->db->where(array('id' => $this->Town_Model->id));
                    $this->db->update($this->session->userdata('universe').'_towns');
                // обновляем армию
                    $this->db->set('army_line', $army_line);
                    $this->db->set('army_start', $army_start);
                    $this->db->where(array('city' => $this->Town_Model->id));
                    $this->db->update($this->session->userdata('universe').'_army');
                // обновляем пользователя
                //    $this->db->set('gold', $gold);
                //    $this->db->where(array('id' => $this->User_Model->id));
                //    $this->db->update($this->session->userdata('universe').'_users');
                // Обучение - найм рабочих на лесопилку
                if ($this->User_Model->tutorial <= 10)
                {
                    $this->tutorials('set', 11);
                }
            }
        }
        redirect($this->config->item('base_url').'game/barracks/'.$id.'/', 'refresh');
    }

    function armyEdit($type = '')
    {
        $this->load->model('Town_Model');
        $this->Town_Model->Town_Load($this->User_Model->town);
        $peoples_army = 0;
        for ($i = 1; $i <= 14; $i++)
        {
                $class = $this->Data_Model->army_class_by_type($i);
                $$class = (isset($_POST[$i])) ? intval($_POST[$i]) : 0 ;
                $cost = $this->Data_Model->army_cost_by_type($i);
                if ($this->User_Model->armys[$this->Town_Model->id]->$class >= $$class)
                {
                    $peoples_army = $peoples_army + ($$class*$cost['peoples']);
                    $this->User_Model->armys[$this->Town_Model->id]->$class = $this->User_Model->armys[$this->Town_Model->id]->$class - $$class;
                }
                $this->db->set($class, $this->User_Model->armys[$this->Town_Model->id]->$class);
        }
        $this->db->where(array('city' => $this->Town_Model->id));
        $this->db->update($this->session->userdata('universe').'_army');
        $this->Town_Model->peoples['free'] = $this->Town_Model->peoples['free'] + $peoples_army;
        // Обновляем жителей
        $this->db->set('peoples', $this->Town_Model->peoples['free']);
        $this->db->where(array('id' => $this->Town_Model->id));
        $this->db->update($this->session->userdata('universe').'_towns');
        redirect($this->config->item('base_url').'game/'.$type.'/', 'refresh');
    }

    function abortUnits($position = 0)
    {
        if($this->User_Model->armys[$this->User_Model->town]->army_line != '')
        {
                // обновляем армию
                $this->db->set('army_line', '');
                $this->db->set('army_start', 0);
                $this->db->where(array('city' => $this->User_Model->town));
                $this->db->update($this->session->userdata('universe').'_army');
        }
        redirect($this->config->item('base_url').'game/barracks/'.$position.'/', 'refresh');
    }

    function abortBuildings($town = 0)
    {
        $id = -1;
        for ($i = 0; $i < SizeOf($this->User_Model->towns); $i++)
        {
            if ($this->User_Model->towns[$i]->id == $town) { $id = $i; }
        }
        if($id >= 0 and $this->User_Model->towns[$id]->build_line != '')
        {
                // обновляем армию
                $this->db->set('build_line', '');
                $this->db->set('build_start', 0);
                $this->db->where(array('id' => $this->User_Model->town));
                $this->db->update($this->session->userdata('universe').'_towns');
        }
        redirect($this->config->item('base_url').'game/city/'.$town.'/', 'refresh');
    }

    function premium($type = '')
    {
        $cost = $this->Data_Model->premium_cost($type);
        if ($this->User_Model->ambrosy >= $cost)
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
            $this->db->set('ambrosy', $this->User_Model->ambrosy - $cost);
            $this->db->where(array('id' => $this->User_Model->id));
            $this->db->update($this->session->userdata('universe').'_users');
        }
        redirect($this->config->item('base_url').'game/premium/', 'refresh');
    }

}

/* End of file actions.php */
/* Location: ./system/application/controllers/actions.php */